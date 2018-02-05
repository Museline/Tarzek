<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Description of ForumPostTitle
 * Gestion des titres et de leur version URL pour les Post
 * @author Khael
 */

/**
 * @ORM\Table(name="forum_post_title")
 * @ORM\Entity(repositoryClass="App\Repository\ForumPostTitleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ForumPostTitle {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var Int $id id du titre en DB 
     */
    private $id;
    
    /**
     *@ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBLank()
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Le titre de l'annonce doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le titre de l'annonce doit contenir au maximum {{ limit }} caractères"
     * )
     * @var string $title titre du post
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
     * @ORM\Column(type="string", length=60, unique=true)
     * @var strin $url_title titre à utiliser dans l'URL
     */
    private $url_title;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ForumSection", inversedBy="subject")
     */
    private $section;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumPost", mappedBy="title")
     * @var 
     */
    private $post;
    
    public function __construct()
    {
        $this->post = new ArrayCollection();
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
    
    public function getId(): Int
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }

    public function getUrlTitle()
    {
        return $this->url_title;
    }

    public function getPost()
    {
        return $this->post;
    }
    
    public function getSection()
    {
        return $this->section;
    }

    public function setId(Int $id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setUrlTitle($url_title)
    {
        $this->url_title = $url_title;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public function setSection($section)
    {
        $this->section = $section;
    }
}


