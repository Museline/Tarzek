<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ForumPost;

/**
 * Description of ForumPostController
 * Controller pour gérer les post des membres sur le forum
 * @author Khael
 */
class ForumPostController extends Controller{
    
    /**
     * @Route("/forum/sujet/{url_title}")
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
}
