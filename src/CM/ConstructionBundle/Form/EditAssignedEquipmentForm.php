<?php

namespace CM\ConstructionBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;

use CM\ConstructionBundle\Entity\Construction;
use CM\ConstructionBundle\Entity\Equipment;

use Symfony\Component\Form\FormBuilderInterface;

class EditAssignedEquipmentForm extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('target', EntityType::class, [
                'attr' => [
                    'class' => 'searchBox'
                ],
                'class' => Construction::class,
                'choice_label' => 'constructionName',
                'placeholder' => 'Wybierz budowę',
                'required' => false,
                'label' => 'Obiekt'
            ])
            ->add('owner', TextType::class, [
                'attr' => [
                    'placeholder' => 'Kto oddał',
                    'maxlength' => '30',
                    'class' => 'searchBox'
                ],
                'required' => false,
                'label' => 'Kto oddał',
            ])
            ->add('recipient', TextType::class, [
                'attr' => [
                    'placeholder' => 'Podaj odbiorcę',
                    'maxlength' => '30',
                    'class' => 'searchBox'
                ],
                'constraints' => [
                    new Length(['min' => 3])
                ],
                'required' => false,
                'label' => 'Odbiorca',
            ])
        ;
    }
}