<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * Description of AvatarType
 * Form pour l'avatar
 * @author Khael
 */
class AvatarType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        
        $builder
                ->add('file', FileType::class, array('required' => false, 'label' => false)
                );
    } 
}
