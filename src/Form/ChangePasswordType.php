<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class,[
            'label'    => 'Votre Prenom',
            'disabled' =>true
           
        ])
        ->add('lastname', TextType::class,[
            'label'    => 'Votre Nom',
            'disabled' =>true
            
        ])
        ->add('email', EmailType::class,[
            'label'    => 'Votre Email',
            'disabled' =>true
        ])
        ->add('old_password', PasswordType::class, [
            'label' => 'mon mot de passe actuel ',
            'mapped'  =>false,
            'attr'  => [
                'placeholder' => 'Merci de saisir votre mot de passe actuel'
            ]],)
        ->add('new_password', RepeatedType::class,[
            'type'  => PasswordType::class,
            'invalid_message' =>' le mot de passe et la confirmation doivent être identique',
            'label'    => 'Votre nouveau Mot de passe',
            'required' => true,
            'mapped'  =>false,
            'first_options' => [
                'label' => 'votre nouveau mot de passe ',
                'attr'  => [
                    'placeholder' => 'Merci de saisir votre nouveau mot de passe'
                ]],
            'second_options' => [
                'label' => 'confirmer votre mot de passe ',
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre nouveau mot de passe'
                ]
            ],
                
        ])
        ->add('submit', SubmitType::class,[
            'label'    => "Modifer",
                
        ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
