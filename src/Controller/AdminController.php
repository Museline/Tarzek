<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Advert;
use App\Form\AdvertType;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function indexAction(Request $request)
    {
        // création d'une nouvelle annonce vide
        $advert = new Advert();

        // mise en place du formulaire lié à l'annonce créé
        $form = $this->createForm(AdvertType::class, $advert);

        $form->handleRequest($request);

        // vérification si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // mise en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            // redirection vers l'accueil admin
            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render('admin/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}