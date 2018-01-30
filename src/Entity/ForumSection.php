<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of ForumSection
 * Sections du forum
 * @author Khael
 */

/**
 * @ORM\Table(name="forum_section")
 * @ORM\Entity(repositoryClass="App\Repository\ForumSectionRepository")
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
     * @Assert\NotBlank()
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
     * @ORM\Column(type="integer")
     */
    private $access;
    
    /**
     * @ORM\Column(type="integer")
     * @var integer $hierarchy hierarcherisation des sections entre elles (section, sous-section, etc)
     */
    private $hierarchy;
    
    /**
     * @ORM\Column(type="string", length=30)
     * 
     */
    private $parent_section;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumPost", mappedBy="section", cascade={"persist", "remove"})
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

    function getHierarchy()
    {
        return $this->hierarchy;
    }

    public function getParentSection()
    {
        return $this->parent_section;
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
    
    function setHierarchy($hierarchy)
    {
        $this->hierarchy = $hierarchy;
    }

    public function setParentSection($parent_section)
    {
        $this->parent_section = $parent_section;
    }


}