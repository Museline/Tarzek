<?php

namespace App\Controller;

use App\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PublicSiteController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $list_advert = $this->getDoctrine()
            ->getRepository(Advert::class)
            ->findBy(array(), array('date_publication' => 'desc'), 5);

        return $this->render('publicsite/index.html.twig', array( 'list_advert' => $list_advert ));
    }

    /**
     * @Route("/jeu", name="game")
     */
    public function gameAction()
    {
        return $this->render('publicsite/game.html.twig');
    }
}