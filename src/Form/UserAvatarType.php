<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\UserAvatar;

/**
 * Description of AvatarType
 * Form pour l'avatar
 * @author Khael
 */
class UserAvatarType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        
        $builder
                ->add('file', FileType::class, array('required' => false, 'label' => false)
                )
                ->add('alt', HiddenType::class, array('required' => false, 'disabled' => true))
                ->add('id', HiddenType::class, array('required' => false, 'disabled' => true))
                ->add('extension', HiddenType::class, array('required' => false, 'disabled' => true));
    } 
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserAvatar::class,
        ));
    }
}
