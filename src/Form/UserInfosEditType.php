<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserInfosEdit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInfosEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => 'e-mail', 'required'   => false))
            ->add('l_name', TextType::class, array('label' => 'Nom', 'required'   => false))
            ->add('f_name', TextType::class, array('label' => 'Prenom', 'required'   => false))
            ->add('adress', TextType::class, array('label' => 'Adresse', 'required'   => false))
            ->add('post_code', TextType::class, array('label' => 'Code Postal', 'required'   => false))
            ->add('city', TextType::class, array('label' => 'Ville', 'required'   => false))
            ->add('phone_numb', TextType::class, array('label' => 'Numéro de Téléphone', 'required'   => false))
            ->add('save', SubmitType::class, array('label' => 'Envoyer'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
