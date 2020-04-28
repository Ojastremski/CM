<?php

namespace CM\AccessBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginForm extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', TextType::class, [
                'label' => 'Użytkownik'
            ])
            ->add('_password', PasswordType::class, [
                'label' => 'Hasło'
            ])
            ->add('rememberme', CheckboxType::class, [
                'label'    => 'Zapamiętaj mnie',
                'required' => false,
            ])
        ;
    }
}