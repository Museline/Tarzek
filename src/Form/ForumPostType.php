<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of ForumPostType
 * Form pour poster des messages
 * @author Khael
 */
class ForumPostType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', TextType::class, array('label' => 'Titre'))
                ->add('description', TextType::class, array('label' => 'Description'))
                ->add('content', TextareaType::class, array('label' => 'Message'))
                ->add('send', SubmitType::class, array('label' => 'Envoyer'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
    }
}
