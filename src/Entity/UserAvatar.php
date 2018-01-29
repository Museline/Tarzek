<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of UserAvatar
 * Classe de gestion de l'avatar de l'utilisateur
 * @author Khael
 */

/**
 * @ORM\Table(name="avatar")
 * @ORM\Entity(repositoryClass="App\Repository\AvatarRepository")
 * @ORM\HasLifecycleCallbacks
 */
class UserAvatar {
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @Assert\Image()
     */
    private $file;

    private $tempFilename;
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload(){
        // si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if ($this->file == null){
            return ;
        }
        
        // le nom de fichier est son id, on doit juste stocker également son extension
        $this->extension = $this->file->guessExtension();
        
        // et on génère l'attriibut alt de l'image pour la balise, à la valeur du nom de fichier upload depuis l'ordi de l'internaute
        $this->alt = $this->file->getClientOriginalName();
        
        // définition de la largeur et de la hauteur maximale
        $width = 300;
        $height = 300;
        
        // content type
        header('Content-Type: image/jpeg');
        
        // calcul des nouvelles dimensions
        list($width_orig, $height_orig) = getimagesize($this->file);
        
        $ratio_orig = $width_orig/$height_orig;
        
        if($width/$height > $ratio_orig){
            $width = $height*$ratio_orig;
        }
        else{
            $height = $width/$ratio_orig;
        }
        
        // redimentionnement
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($this->file);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        
        imagejpeg($image_p, $this->getUploadDir().'/temp.'.$this->extension, 100);
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file)
        {
            return;
        }

        // Si on avait un ancien fichier, on le supprime
        if (null !== $this->tempFilename)
        {
            $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;

            if (file_exists($oldFile))
            {
                unlink($oldFile);
            }
        }

        // On renomme le fichier
        if(file_exists($this->getUploadDir().'/temp.'.$this->extension))
        {
            rename($this->getUploadDir().'/temp.'.$this->extension, $this->getUploadDir().'/'.$this->id.'.'.$this->extension);
        }
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->extension;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
        if (file_exists($this->tempFilename))
        {
            // On supprime le fichier
            unlink($this->tempFilename);
        }
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
        return 'images/uploads';
    }

    public function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return $GLOBALS['kernel']->getContainer()->getParameter('stockage_image');
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getExtension();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return Image
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (null !== $this->extension)
        {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->tempFilename = $this->extension;

            // On réinitialise les valeurs des attributs extension et alt
            $this->extension = null;
            $this->alt = null;
        }
    }


}
