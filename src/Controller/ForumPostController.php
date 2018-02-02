<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ForumPost;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ForumPostType;

/**
 * Description of ForumPostController
 * Controller pour gérer les post des membres sur le forum
 * @author Khael
 */
class ForumPostController extends Controller{
    
    /**
     * @Route("/forum/sujet/{url_title}", name="sujet")
     */
    public function pagePost($url_title){
        
        $forum_post = $this->getDoctrine()
                ->getRepository(ForumPost::class)
                ->findBy(array('url_title' => $url_title),array('date_post' => 'asc'));
        
        foreach ($forum_post as $value){
            $value->setDatePostStr($value->getDatePost()->format('d-m-Y H:i'));
            if( null !== $value->getDateEdit()){
            $value->setDateEditStr($value->getDateEdit()->format('d-m-Y H:i'));
            }
            else{
                $value->setDateEditStr(0);
            }
        }
        
        // dump($forum_post);
        
        return $this->render('publicsite/postforum.html.twig', array('forum_post' => $forum_post));
    }
    
    /**
     * @Route("/forum/reponse/{url_title}/{section}", name="response", defaults={"section" = null})
     */
    public function newPost(Request $request, $url_title, $section){
        
        if($url_title == 'new_subject'){
            
            // création d'un nouveau post
            $new_post = new ForumPost();        

            // $new_user->setAvatarUpload($avatar);
            // création du formulaire d'inscription du nouvel utilisateur
            $form_post = $this->createForm(ForumPostType::class, $new_post);

            $form_post->handleRequest($request);
        
            // verification si les données du form sont envoyées et valides
            if($form_post->isSubmitted() && $form_post->isValid()){

                // ajout de l'auteur
                $user = $this->getUser();
                $form_post->setAuthor($user);

                // mise en DB
                $edb = $this->getDoctrine()->getManager();
                $edb->persist($new_post);
                $edb->flush();

                $this->addFlash('success', 'Message envoyé');

                // redirection vers la page de Connexion (vers homepage tant que login non créée)
                return $this->redirectToRoute('sujet', array('url_title' => $url_title));
            }
        }
        
        $forum_post = $this->getDoctrine()
                ->getRepository(ForumPost::class)
                ->findBy(array('url_title' => $url_title),array('date_post' => 'asc'));
        
        
    }
}
