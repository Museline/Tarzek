<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdvertRepository")
 * @ORM\Table(name="advert")
 * @UniqueEntity(
 *     "title",
 *     message="Ce titre d'annonce a déjà été utilisé. Chaque titre doit être unique."
 * )
 */
class Advert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @var string $title titre de l'annonce
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Le titre de l'annonce doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le titre de l'annonce doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @var string $content contenu de l'annonce
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 20,
     *      minMessage = "Le contenu de l'annonce doit contenir au minimum {{ limit }} caractères"
     * )
     */
    private $content;

    /**
     * @var \DateTime $date_publication date de la publication de l'annonce
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $date_publication;

    /**
     * @var string $category catégorie de l'annonce (maj, event, scoreboard)
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"maj", "event", "scoreboard"}, message="Le nom de la catégorie n'est pas valide")
     */
    private $category;

    public function __construct()
    {
        $this->date_publication = new \Datetime();
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return string titre de l'annonce
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title titre de l'annonce
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string contenu de l'annonce
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content contenu de l'annonce
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime date de la publication de l'annonce
     */
    public function getDatePublication()
    {
        return $this->date_publication;
    }

    /**
     * @param \DateTime $date_publication date de la publication de l'annonce
     */
    public function setDatePublication($date_publication)
    {
        $this->date_publication = $date_publication;
    }

    /**
     * @return string catégorie de l'annonce (maj, event, scoreboard)
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category catégorie de l'annonce (maj, event, scoreboard)
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
}
