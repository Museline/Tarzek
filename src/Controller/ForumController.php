<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ForumController
 * Controller pour afficher forum
 * @author Khael
 */
class ForumController extends Controller{
    
    /**
     * @Route("/Forum", name="forum")
     */
    public function indexForum(){
        
        $list_section = $this->getDoctrine()
                ->getRepository(Forum::class)
                ->findAll();
        
        return $this->render('publicsite/forum.html.twig', array('list_section' => $list_section));
    }
    
    
    
    public function postForum(){
        
        $list_subject = $this->getDoctrine()
                ->getRepository(ForumPost::class)
                ->findAll();
    }
}
