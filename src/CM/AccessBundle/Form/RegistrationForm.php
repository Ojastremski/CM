<?php

namespace CM\AccessBundle\Form;

use CM\AccessBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Podaj imię',
                    'maxlength' => '32',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'label' => 'Imię*',
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Podaj nazwisko',
                    'maxlength' => '32',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'label' => 'Nazwisko*',
            ])
            ->add('_username', TextType::class, [
                'attr' => [
                    'placeholder' => 'Podaj login',
                    'maxlength' => '32',
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 4]),
                ],
                'label' => 'Login*'
            ])
            ->add('email', EmailType::class)
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

    
}