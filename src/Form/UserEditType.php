<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserEditType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('username', TextType::class)
                ->add('roles', ChoiceType::class, array(
                    'choices'  => array(
                        'Simple utilisateur' => 'ROLE_USER',
                        'Admin' => 'ROLE_ADMIN',
                        'Super admin' => 'ROLE_SUPER_ADMIN',
                    ),
                    'multiple' => true
                ))
                ->add('send', SubmitType::class);
    }
                
}
