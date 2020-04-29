<?php

namespace CM\ConstructionBundle\Form;

use CM\ConstructionBundle\Form\Type\DateTimePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ConstructionForm extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('constructionName', TextType::class, [
                'attr' => [
                    'autofocus' => true,
                    'maxlength' => '80'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'label' => 'Nazwa objektu*'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis',
                'required' => false
            ])
            ->add('note', TextareaType::class, [
                'attr' => [
                    'maxlength' => '100'
                ],
                'required' => false,
                'label' => 'Notatka'
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