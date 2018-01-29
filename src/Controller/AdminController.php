<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\User;
use App\Form\AdvertType;
use App\Form\UserEditType;
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

            // ajout de l'auteur
            $user =  $this->getUser();
            $advert->setAuthor($user);

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

    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function userAction(Request $request)
    {
        $search_username = $request->request->get('search_username');

        if($search_username) {
            $list_users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findUsersSearch($search_username);
        } else {
            $list_users = null;
        }

        return $this->render('admin/user.html.twig', array('list_users' => $list_users));
    }

    /**
     * @Route("/admin/user_edit/{id}", name="admin_user_edit")
     */
    public function userEditAction(Request $request, $id)
    {
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository(User::class)
            ->find($id)
        ;

        /*** Création du formulaire ***/
        $form = $this->createForm(UserEditType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash(
                'success',
                'L\'utilisateur a bien été modifié'
            );

            return $this->redirect($this->generateUrl('admin_user'));
        }
        /*************************************/

        return $this->render('admin/useredit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/user_remove/{id}", name="admin_user_remove")
     */
    public function userRemoveAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)
            ->find($id);

        $em->remove($user);
        $em->flush();

        $this->addFlash(
            'success',
            'L\'utilisateur a bien été supprimé'
        );

        return $this->redirect($this->generateUrl('admin_user'));
    }
}