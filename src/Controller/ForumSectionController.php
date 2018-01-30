<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ForumSection;
// use App\Service\ForumService;
// use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ForumController
 * Controller pour afficher forum
 * @author Khael
 */
class ForumSectionController extends Controller{
    
    /**
     * @Route("/forum", name="forum")
     */
    public function indexForum(){
        
        $list_section = $this->getDoctrine()
                ->getRepository(ForumSection::class)
                ->findAll();
        
        // dump($list_section);
        // dump($order->sectionOrder($list_section));
        
        return $this->render('publicsite/indexforum.html.twig', array('list_section' => $list_section));
    }
    
    public function postForum(){
        
        $list_subject = $this->getDoctrine()
                ->getRepository(ForumPost::class)
                ->findAll();
        
        return $this->render('publicsite/sujetforum.html.twig', array('list_subject' => $list_subject));
    }
}
