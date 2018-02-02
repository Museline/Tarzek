<?php

namespace App\Controller;

use App\Entity\PrivateMessage;
use App\Entity\PrivateMessageReading;
use App\Form\PrivateMessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrivateSiteController extends Controller
{
    /**
     * @Route("/compte/messagerie", name="messaging")
     */
    public function messagingAction()
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        // récupération des messages reçus grâce à PrivateMessageReading pour avoir les lu/non lu en même temps
        $list_messages_received = $em->getRepository(PrivateMessageReading::class)
                                    ->findByRecipient($user);

        // récupération des messages expédiés
        $list_messages_sent = $this->getDoctrine()
            ->getManager()
            ->getRepository(PrivateMessage::class)
            ->findBySender($user)
        ;

        return $this->render('privatesite/messaging.html.twig', array(
            'list_messages_received' => $list_messages_received,
            'list_messages_sent' => $list_messages_sent
        ));
    }

    /**
     * @Route("/compte/message/creation", name="message_create")
     */
    public function messageCreateAction(Request $request)
    {
        // création d'un nouveau message privé vide
        $message = new PrivateMessage();

        // mise en place du formulaire lié au message privé créé
        $form = $this->createForm(PrivateMessageType::class, $message);

        $form->handleRequest($request);

        // vérification si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            // ajout de l'expéditeur
            $user =  $this->getUser();
            $message->setSender($user);

            // mise en bdd
            $em->persist($message);
            $em->flush();

            // ajout de la gestion des messages lu/non lu
            $recipients = $message->getRecipients();
            $length = count($recipients);

            for($i=0; $i < $length; $i++) {

                $reading = new PrivateMessageReading();

                $reading->setMessage($message);
                $reading->setRecipient($recipients[$i]);

                $em->persist($reading);
                $em->flush();
            }

            $this->addFlash(
                'success',
                'Le message a bien été envoyé'
            );

            // redirection vers l'accueil admin
            return $this->redirectToRoute('messaging');
        }

        return $this->render('privatesite/message_create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/compte/message/vue/{id}", name="message_view")
     */
    public function messageViewAction($id)
    {
        // TODO: vérifier si l'utilisateur n'a pas modifier l'url pour accéder à des messages d'autres personnes
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $message = $em->getRepository(PrivateMessage::class)
            ->find($id);

        // vérification du bool de lecture et modification si en non lu
        $tab_message = $em->getRepository(PrivateMessageReading::class)
                            ->findByUserAndMessage($user, $message);

        foreach ($tab_message as $message_received) {
            if($message_received != null)
            {
                if($message_received->isReading() == false) {
                    $message_received->setReading(true);

                    $em->flush();
                }
            }
        }

        return $this->render('privatesite/message_view.html.twig', array(
            'message' => $message,
        ));
    }
}