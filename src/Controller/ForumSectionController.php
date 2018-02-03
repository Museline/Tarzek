<?php

namespace App\Controller;

use App\Form\ForumSectionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        
        // dump($list_section);
      
        
        return $this->render('forum/indexforum.html.twig', array('list_section' => $list_section));
    }

    /**
     * @Route("/forum/admin/section", name="forum_admin_section")
     */
    public function adminSectionForum(Request $request){
        $section = new ForumSection();

        $form = $this->createForm(ForumSectionType::class, $section);

        $form->handleRequest($request);

        // vérification si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {

            $section->setHierarchy(1);
            $section->setParentSection('index');

            // mise en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();

            // redirection vers l'accueil du forum
            return $this->redirectToRoute('forum');
        }

        return $this->render('forum/forum_admin_section.html.twig', array(
            'form' => $form->createView(),
        ));
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
        
        // dump($list_section);
        
        $list_subject = $this->getDoctrine()
                ->getRepository(ForumPost::class)
                ->findBy(array('section' => $pre_query->getId()));
        
        // dump($list_subject);
        
        return $this->render('forum/pageforum.html.twig', array(
                                                                    'pre_query' => $pre_query,
                                                                    'list_subject' => $list_subject,
                                                                    'list_section' => $list_section
                                                                )
                            );
    }
}
