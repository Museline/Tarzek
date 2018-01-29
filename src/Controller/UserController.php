<?php

namespace App\Controller;

use App\Entity\User;
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
     * @Route("/profil", name="profil")
     * 
     */
    public function profilUser(){
        
        return $this->render('privatesite/profil.html.twig');
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
