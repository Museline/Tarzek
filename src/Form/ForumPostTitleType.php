<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ForumPostTitle;


/**
 * Description of ForumPostTitleType
 *
 * @author Khael
 */
class ForumPostTitleType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('title', TextType::class, array('label' => 'Titre'))
                ->add('description', TextType::class, array('label' => 'Description'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ForumPostTitle::class,
        ));
    }
}
