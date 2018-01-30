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
     * @var \DateTime $date_edit date de la dernière edition du message
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $date_edit;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ForumSection", inversedBy="post")
     */
    private $section;
    
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


}
