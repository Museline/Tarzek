<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;

/**
 * Description of ForumSection
 * Sections du forum
 * @author Khael
 */
class ForumSection {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\Length(
     *      min=3,
     *      max=60,
     *      minMessage = "Le titre de la section doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le titre de la section ne doit pas excéder {{ limit }} caractères"
     * )
     */
    private $section_name;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min=3,
     *      max=255,
     *      minMessage = "Le titre de la section doit contenir au moins {{ limit }} caractères",
     *      maxMessage = "Le titre de la section ne doit pas excéder {{ limit }} caractères"
     * )
     */
    private $description;
    
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $access;
    
    /**
     * @ORM\Column(type="string", legnth=40)
     * @var integer $order organisation des sections entre elles (principale, sous-section)
     */
    private $order;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumPost", inversedBy="section", cascade={"persist", "remove"})
     */
    private $post;
    
    public function getId(){
        return $this->id;
    }
    
    function getSectionName()
    {
        return $this->section_name;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getAccess()
    {
        return $this->access;
    }

    function getOrder()
    {
        return $this->order;
    }

        
    function setSectionName($section_name)
    {
        $this->section_name = $section_name;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setAccess($access)
    {
        $this->acces = $access;
    }
    
    function setOrder($order)
    {
        $this->order = $order;
    }


}
