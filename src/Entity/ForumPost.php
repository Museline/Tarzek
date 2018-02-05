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
 * @ORM\HasLifecycleCallbacks
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
     * @var in $title lien avec la table titre
     * @ORM\ManyToOne(targetEntity="App\Entity\ForumPostTitle", inversedBy="post", cascade={"persist"})
     * 
     */
    private $title;
    
    /**
     * @var string $content Message posté par l'utilisateur
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
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
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $date_edit;
    
    
    public function __construct(){
        
        $this->date_post = new \Datetime();
    }
    
    function getAuthor()
    {
        return $this->author;
    }

    function getTitle()
    {
        return $this->title;
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

    public function setContent($content)
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
