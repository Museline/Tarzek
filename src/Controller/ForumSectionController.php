<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ForumSection;
use App\Entity\ForumPost;
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
        
        dump($list_section);
     
        
        return $this->render('publicsite/indexforum.html.twig', array('list_section' => $list_section));
    }
    
    /**
    * @Route("/forum/{url_name}")
    */
    public function sectionForum($url_name){
        
        $pre_query = $this->getDoctrine()
                ->getRepository(ForumSection::class)
                ->findOneBy(array('url_name' => $url_name));
        
        dump($pre_query);
        
        $list_section = $this->getDoctrine()
                ->getRepository(ForumSection::class)
                ->findBy(array('parent_section' => $pre_query->getSectionName()));
        
        dump($list_section);
        
        $list_subject = $this->getDoctrine()
                ->getRepository(ForumPost::class)
                ->findBy(array('section' => $pre_query->getId()));
        
        dump($list_subject);
        
        return $this->render('publicsite/pageforum.html.twig', array(
                                                                    'pre_query' => $pre_query,
                                                                    'list_subject' => $list_subject,
                                                                    'list_section' => $list_section
                                                                ));
    }
}
