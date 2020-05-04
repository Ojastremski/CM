<?php

namespace CM\ConstructionBundle\Form;

use CM\ConstructionBundle\Form\Type\DateTimePickerType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use CM\ConstructionBundle\Entity\Construction;
use CM\ConstructionBundle\Entity\Category;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;

class EquipmentForm extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('equipmentName', TextType::class, [
                'attr' => [
                    'autofocus' => true,
                    'maxlength' => '40'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'label' => 'Nazwa sprzętu*'
            ])
            ->add('equipmentCategory', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'categoryName',
                'placeholder' => 'Wybierz kategorię',
                'required' => false,
                'label' => 'Kategoria'
            ])
            ->add('equipmentSerialNumber', TextType::class, [
                'attr' => [
                    'maxlength' => '30'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2]),
                ],
                'label' => 'Nr. seryjny'
            ])
            ->add('note', TextareaType::class, [
                'attr' => [
                    'maxlength' => '100',
                ],
                'label' => 'Notatka',
                'required' => false
            ])
            ->add('noteVisibility', ChoiceType::class, [
                'choices'  => [
                    'Główna strona' => 'main',
                    'Podstrona' => 'subpage',
                    'Wyłączyć' => 'disabled'
                ],
                'disabled' => 'disabled',
                'label' => 'Widoczność notatki'
            ])
            ->add('target', EntityType::class, [
                'class' => Construction::class,
                'choice_label' => 'constructionName',
                'placeholder' => 'Wybierz budowę',
                'required' => false,
                'label' => 'Wydanie na budowę'
            ])
            ->add('recipient', TextType::class, [
                'attr' => [
                    'maxlength' => '30'
                ],
                'constraints' => [
                    new Length(['min' => 3])
                ],
                'required' => false,
                'label' => 'Odbiorca'
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'preSetData'])
        ;
    }

    public function preSetData(FormEvent $event) {
        $publishedAt = $event->getData()->getPublishedAt();
        $event
            ->getForm()            
            ->add('publishedAt', DateTimePickerType::class, [
                'label' => 'Data utworzenia*',
                'disabled' => ($publishedAt !== null)
            ]);
    }
}