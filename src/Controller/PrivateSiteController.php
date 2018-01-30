<?php

namespace App\Controller;

use App\Entity\PrivateMessage;
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
        return $this->render('privatesite/messaging.html.twig');
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

            // ajout de l'expéditeur
            $user =  $this->getUser();
            $message->setSender($user);

            // mise en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

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
}