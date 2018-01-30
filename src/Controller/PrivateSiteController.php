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
     * @Route("/messagerie", name="messaging")
     */
    public function messagingAction()
    {
        $user = $this->getUser();

        $list_messages = $this->getDoctrine()
            ->getManager()
            ->getRepository(PrivateMessage::class)
            ->findBySender($user)
        ;

        return $this->render('privatesite/messaging.html.twig', array(
            'list_messages' => $list_messages,
        ));
    }

    /**
     * @Route("/message/creation", name="message_create")
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
     * @Route("/message/vue/{id}", name="message_view")
     */
    public function messageViewAction($id)
    {
        $message = $this->getDoctrine()
            ->getManager()
            ->getRepository(PrivateMessage::class)
            ->find($id)
        ;

        return $this->render('privatesite/message_view.html.twig', array(
            'message' => $message,
        ));
    }
}