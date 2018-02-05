<?php

namespace App\Controller;

use App\Entity\Score;
use App\Entity\User;
use App\Form\UserAvatarEditType;
use App\Form\UserInfosEditType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\UserAvatar;


/**
 * Description of UserController
 * Controller d'enregistrement User
 * @author Khael
 */
class UserController extends Controller{
    
    /**
     * @Route("/inscription", name="registration")
     */
    public function newUser(Request $request, UserPasswordEncoderInterface $encoder){
        
        // création d'un nouvel Utilisateur
        $new_user = new User();
        // $avatar = new UserAvatar;
        
        // $new_user->setAvatarUpload($avatar);
        // création du formulaire d'inscription du nouvel utilisateur
        $form_user = $this->createForm(UserType::class, $new_user);
        
        $form_user->handleRequest($request);
        
        // verification si les données du form sont envoyées et valides
        if($form_user->isSubmitted() && $form_user->isValid()) {
            
            $encoded = $encoder->encodePassword($new_user, $new_user->getPassword());
            $new_user->setPassword($encoded);
            
            // mise en DB
            $edb = $this->getDoctrine()->getManager();
            $edb->persist($new_user);
            $edb->flush();
            
            $this->addFlash('success', 'Compte utilisateur créé. Bienvenue');
            
            // redirection vers la page de Connexion (vers homepage tant que login non créée)
            return $this->redirectToRoute('login');
        }
        
        return $this->render('publicsite/registration.html.twig', array("form" => $form_user->createView()));
    }
    
    /**
     * @Route("/compte/profil", name="profil")
     * 
     */
    public function profilUser(){

        $user = $this->getUser();

        $scoreboard = $this->getDoctrine()
            ->getRepository(Score::class)
            ->findOneByUser($user);

        // Si le joueur n'a pas encore de score
        if(!$scoreboard)
        {
            $scoreboard = null;
        }

        return $this->render('privatesite/profil.html.twig', array('scoreboard' => $scoreboard));
    }

    /**
     * @Route("/compte/profil/edit/avatar", name="profil_edit_avatar")
     */
    public function profilEditAvatarUser(Request $request){

        $user = $this->getUser();

        // mise en place du formulaire lié à l'annonce créé
        $form = $this->createForm(UserAvatarEditType::class, $user);

        $form->handleRequest($request);

        // vérification si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // mise en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'L\'avatar a bien été modifié'
            );

            // redirection vers l'accueil admin
            return $this->redirectToRoute('profil');
        }

        return $this->render('privatesite/avatar_edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/compte/profil/edit/infos", name="profil_edit_infos")
     */
    public function profilEditInfosUser(Request $request){

        $user = $this->getUser();

        // mise en place du formulaire lié à l'annonce créé
        $form = $this->createForm(UserInfosEditType::class, $user);

        $form->handleRequest($request);

        // vérification si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // mise en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Vos informations ont bien été modifié'
            );

            // redirection vers l'accueil admin
            return $this->redirectToRoute('profil');
        }

        return $this->render('privatesite/infos_edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
    * @Route("/login", name="login")
    */
    public function login(Request $request, AuthenticationUtils $auth_utils){
        
        $error = $auth_utils->getLastAuthenticationError();
        
        $last_username = $auth_utils->getLastUsername();
        
        return $this->render('publicsite/login.html.twig', array(
            'last_username' => $last_username,
            'error' => $error,
        ));
   
    }
}
