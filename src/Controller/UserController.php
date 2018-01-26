<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Description of UserController
 * Controller d'enregistrement User
 * @author Khael
 */
class UserController extends Controller{
    
    /**
     * @Route("/inscription", name="inscription")
     */
    public function newUser(Request $request, UserPasswordEncoderInterface $encoder){
        
        // création d'un nouvel Utilisateur
        $new_user = new User();
                
        // création du formulaire d'inscription du nouvel utilisateur
        $form_user = $this->createForm(UserType::class, $new_user);
        
        $form_user->handleRequest($request);
        
        // verification si les données du form sont envoyées et valides
        if($form_user->isSubmitted() && $form_user->isValid()) {
            
            $encoded = $encoder->encodePassword($new_user, $new_user->getSalt());
            $new_user->setPassword($encoded);
            
            // mise en DB
            $edb = $this->getDoctrine()->getManager();
            $edb->persist($new_user);
            $edb->flush();
            
            $this->addFlash('success', 'Compte utilisateur créé. Bienvenue');
            
            // redirection vers la page Profil
            $this->redirectToRoute('homepage');
        }
        
        return $this->render('publicsite/registration.html.twig', array("form" => $form_user->createView()));
    }
    
    /**
     * @Route("/profil", name="profil")
     * 
     */
    public function profilUser($id){
        
        $user_profil = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($id);
        
        if (!$user_profil){
            throw $this->createNotFoundException('Pas d\'utilisateur enregistré sous cette Id');
        }
        
        return $this->render('profil.html.twig', array('user_profil' => $user_profil));
    }
}
