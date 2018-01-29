<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
/**
 * Description of UserType
 * Génération formulaire d'incription des User
 * @author Khael
 */


class UserType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('username', TextType::class, array('label' => 'Pseudo'))
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe doivent correspondrent',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'Mot de Passe'),
                    'second_options' => array('label' => 'Confirmer Mot de Passe'),
                ))
                ->add('email', EmailType::class, array('label' => 'e-mail'))
                ->add('l_name', TextType::class, array('label' => 'Nom'))
                ->add('f_name', TextType::class, array('label' => 'Prenom'))
                ->add('adress', TextType::class, array('label' => 'Adresse'))
                ->add('city', TextType::class, array('label' => 'Ville'))
                ->add('post_code', TextType::class, array('label' => 'Code Postal'))
                ->add('phone_numb', TextType::class, array('label' => 'Numéro de Téléphone'))
                ->add('avatar_URL', UrlType::class, array('label' => 'Avatar'))
                // ->add('avatar_upload', FileType::class, array('label' => 'Avatar'))              
                ->add('send', SubmitType::class, array('label' => 'Envoyer'));
    }
                
}
