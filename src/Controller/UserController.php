<?php

namespace App\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of UserController
 * Controller d'enregistrement User
 * @author Khael
 */
class UserController extends Controller{
    
    /**
     * @Route("/inscription", name="inscription")
     */
    public function newUser(Request $request){
        
        // création d'un nouvel Utilisateur
        $new_user = new User();
        
        // création du formulaire d'inscription du nouvel utilisateur
        $form_user = $this->createForm(UserType::class, $new_user);
        
        $form_user->handleRequest($request);
        
        // verification si les données du form sont envoyées et valides
        if($form_user->isSubmitted() && $form_user->isValid()) {
            
            // mise en DB
            $edb = $this->getDoctrine()->getManager();
            $edb->persist($new_user);
            $edb->flush();
            
            $this->addFlash('success', 'Compte utilisateur créé. Bienvenue');
            
            // redirection vers la page Profil
            $this->redirectToRoute('profil');
        }
        
        return $this->render('', $parameters)
    }
}
