<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Score
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var array $scoreboard tableau regroupant le meilleur score du joueur par niveau
     * @ORM\Column(type="array")
     */
    private $scoreboard;

    /**
     * @var integer $final_score score final après addition de tous les scores par niveau
     * @ORM\Column(type="integer")
     */
    private $final_score;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function calculateFinalScore() {

        $this->final_score = 0;

        foreach($this->scoreboard as $score) {
            $this->final_score += $score;
        }

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getScoreboard(): array
    {
        return $this->scoreboard;
    }

    /**
     * @param array $scoreboard
     */
    public function setScoreboard(array $scoreboard): void
    {
        $this->scoreboard = $scoreboard;
    }

    /**
     * @return mixed
     */
    public function getFinalScore()
    {
        return $this->final_score;
    }
}
