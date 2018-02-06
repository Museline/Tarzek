<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ForumPost;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ForumPostType;
use App\Entity\ForumSection;
use App\Entity\ForumPostTitle;

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
        
        $forum_post_title = $this->getDoctrine()
                ->getRepository(ForumPostTitle::class)
                ->findOneBy(array('url_title' => $url_title));
        
        // dump($forum_post_title);
        
        $forum_post = $this->getDoctrine()
                ->getRepository(ForumPost::class)
                ->findBy(array('title' => $forum_post_title), array('date_post' => 'asc'));
        
        // dump($forum_post);        
        
        return $this->render('forum/postforum.html.twig', array('forum_post_title' => $forum_post_title,
                                                                'forum_post' => $forum_post));
    }
    
    /**
     * @Route("/forum/reponse/{url_title}/{section}", name="response", defaults={"section" = null})
     */
    public function newPost(Request $request, $url_title, $section){
        
        if($url_title == 'new_subject'){
            
            // création d'un nouveau post
            $new_post = new ForumPost();
            $new_title = new ForumPostTitle();
            $new_post->setTitle($new_title);
                  
            // récup des infos de la section ou on créer le sujet
            $pre_query = $this->getDoctrine()
                ->getRepository(ForumSection::class)
                ->findOneBy(array('url_name' => $section));
            
            // dump($pre_query);

            // création du formulaire pour écrire le post
            $form_post = $this->createForm(ForumPostType::class, $new_post);

            $form_post->handleRequest($request);
        
            // verification si les données du form sont envoyées et valides
            if($form_post->isSubmitted() && $form_post->isValid()){

                // ajout de l'auteur
                $user = $this->getUser();
                $new_post->setAuthor($user);
                $new_title->setSection($pre_query);
                
                // mise en DB
                $edb = $this->getDoctrine()->getManager();
                $edb->persist($new_post);
                $edb->persist($pre_query);
                $edb->persist($new_title);
                $edb->flush();

                $this->addFlash('success', 'Message envoyé');

                // redirection vers la page de Connexion 
                return $this->redirectToRoute('sujet', array('url_title' => $new_title->getUrlTitle()));
            }
            return $this->render('forum/newpostforum.html.twig', array('form' => $form_post->createView(),
                                                                       'pre_query' => $pre_query));
        }
        else{
        
            // récup du titre du sujet
            $forum_post_title = $this->getDoctrine()
                    ->getRepository(ForumPostTitle::class)
                    ->findOneBy(array('url_title' => $url_title));
            
            // récup des autres post du sujet
            $forum_post = $this->getDoctrine()
                    ->getRepository(ForumPost::class)
                    ->findBy(array('title' => $forum_post_title),array('date_post' => 'desc'));
            
            // création d'un nouveau post
            $new_post = new ForumPost();

            //creation du formulaire
            $form_post = $this->createForm(ForumPostType::class, $new_post);
            
            $form_post->handleRequest($request);
            
            // Enregistrement du post si il passe les validations
            if($form_post->isSubmitted() && $form_post->isValid()){
                // ajout de l'auteur et de la section
                $user = $this->getUser();
                $new_post->setAuthor($user);
                // $new_post->setSection($forum_post_title->getSection());
                $new_post->setTitle($forum_post_title);
                // $new_post->setDescription($forum_post[0]->getDescription());
                
                $edb = $this->getDoctrine()->getManager();
                $edb->persist($new_post);
                $edb->flush();
                
                $this->addFlash('succes', 'Message envoyé');
                
                // redirection vers la page du sujet 
                return $this->redirectToRoute('sujet', array('url_title' => $url_title));
            }
            
            return $this->render('forum/newpostforum.html.twig', array('form' => $form_post->createView(), 'forum_post' => $forum_post, 'forum_post_title' => $forum_post_title));
        } 
    }
}
