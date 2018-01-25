<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/admin/advert", name="admin_advert")
     */
    public function advertAction(Request $request)
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

            $this->addFlash(
                'success',
                'L\'annonce a bien été ajouté'
            );

            // redirection vers l'accueil admin
            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render('admin/advert.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}