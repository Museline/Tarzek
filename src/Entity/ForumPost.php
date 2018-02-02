<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of ForumPost
 * Posts du forum
 * @author Khael
 */

/**
 * @ORM\Table(name="forum_post")
 * @ORM\Entity(repositoryClass="App\Repository\ForumPostRepository")
 */
class ForumPost {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $author;
    
    /**
     * @var string $title titre du sujet
     * @ORM\Column(type="string", length=60, unique=true)
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
     * @var string $description description du sujet
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      max=100,
     *      maxMessage = "Le contenu de la description ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $description;
    
    /**
     * @var string $content Message posté par l'utilisateur
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 20,
     *      minMessage = "Le contenu de l'annonce doit contenir au minimum {{ limit }} caractères"
     * )
     */
    private $content;
    
    /**
     * @var \DateTime $date_publication date de post du message
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $date_post;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @var string $date_post_str date au format str
     */
    private $date_post_str;
    
    /**
     * @var \DateTime $date_edit date de la dernière edition du message
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $date_edit;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @var string $date_edit_str date au format str
     */
    private $date_edit_str;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ForumSection", inversedBy="post")
     */
    private $section;
    
    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @var string $url_title nom à utiliser dans l'URL
     */
    private $url_title;
    
    function getAuthor()
    {
        return $this->author;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getContent()
    {
        return $this->content;
    }

    function getDatePost(): \DateTime
    {
        return $this->date_post;
    }

    function getDateEdit()
    {
        return $this->date_edit;
    }

    function getId()
    {
        return $this->id;
    }

    public function getSection()
    {
        return $this->section;
    }

    public function getUrlTitle()
    {
        return $this->url_title;
    }

    public  function getDatePostStr()
    {
        return $this->date_post_str;
    }

    public function getDateEditStr()
    {
        return $this->date_edit_str;
    }
    
    function setAuthor($author)
    {
        $this->author = $author;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setContent($content)
    {
        $this->content = $content;
    }

    function setDatePost(\DateTime $date_post)
    {
        $this->date_post = $date_post;
    }

    function setDateEdit($date_edit)
    {
        $this->date_edit = $date_edit;
    }

    public function setSection($section)
    {
        $this->section = $section;
    }

    public function setUrlTitle($url_title)
    {
        $this->url_title = $url_title;
    }

    public function setDatePostStr($date_post_str)
    {
        $this->date_post_str = $date_post_str;
    }

    public function setDateEditStr($date_edit_str)
    {
        $this->date_edit_str = $date_edit_str;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function concatenation()
    {
        // recupère le nom de la catégorie
        $this->url_title = $this->title;

        // efface les espaces au début et à la fin de la chaîne
        $this->url_title = trim($this->url_title);

        // modifie les caractères spéciaux
        $trans = array("à" => "a", "ç" => "c", "é" => "e", "è" => "e", "ê" => "e", "ë" => "e", "í" => "i", "ì" => "i", "î" => "i", "ï" => "i", "ó" => "o", "ò" => "o", "ô" => "o", "ö" => "o", "ú" => "u", "ù" => "u", "û" => "u", "ü" => "u", "ÿ" => "y", "æ" => "ae", "œ" => "oe", "À" => "a", "Ç" => "c", "É" => "e", "È" => "e", "Ê" =>"e", "Ë" =>"e", "Í" => "i", "Ì" => "i", "Î" => "i", "Ï" => "i", "Ó" => "o", "Ò" => "o", "Ô" => "o", "Ö" => "o", "Ú" => "u", "Ù" => "u", "Û" => "u", "Ü" => "u", "Ÿ" => "y", "Æ" => "ae", "Œ" => "oe");

        $this->url_title = strtr($this->url_title, $trans);

        // transfome la chaine en minuscule
        $this->url_title = strtolower($this->url_title);

        // transforme les espaces en tiret
        $this->url_title = strtr($this->url_title, array(" " => "-", "," => "", "'" => ""));
    }
}
