<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Entity\Score;
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

    /**
     * @Route("/classement", name="ladder")
     */
    public function ladderAction()
    {
        $list_scoreboard = $this->getDoctrine()
            ->getRepository(Score::class)
            ->findBy(array(), array('final_score' => 'DESC'));

        foreach ($list_scoreboard as $obj_score) {

            $user = $obj_score->getUser();
            $username = $user->getUsername();

            $scoreboard = $obj_score->getScoreboard();

            foreach ($scoreboard as $key => $score) {

                // on vérifie si on a déjà une entrée pour ce niveau
                if(isset($ladder[$key]['score'])) {

                    // si le nouveau score est plus élevé, on enregistre le nouveau score
                    if($score > $ladder[$key]['score']) {
                        $ladder[$key] = ['username' => $username, 'score' => $score];
                    }

                } else {
                    // si on a pas d'entrée pour ce niveau, on rentre le score du joueur
                    $ladder[$key] = ['username' => $username, 'score' => $score];
                }
            }
        }

        return $this->render('publicsite/ladder.html.twig', array(
            'list_scoreboard' => $list_scoreboard,
            'ladder' => $ladder
        ));
    }
}