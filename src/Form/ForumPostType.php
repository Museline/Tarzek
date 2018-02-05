<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Form\ForumPostTitleType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ForumPost;

/**
 * Description of ForumPostType
 * Form pour poster des messages
 * @author Khael
 */
class ForumPostType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', ForumPostTitleType::class, array('label' => false ))
                ->add('content', TextareaType::class, array('label' => 'Message'))
                ->add('send', SubmitType::class, array('label' => 'Envoyer'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ForumPost::class,
        ));
    }
}
