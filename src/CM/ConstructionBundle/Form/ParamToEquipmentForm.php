<?php

namespace CM\ConstructionBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use CM\ConstructionBundle\Entity\Construction;
use CM\ConstructionBundle\Entity\Category;
use CM\ConstructionBundle\Entity\Equipment;
use Symfony\Component\Form\FormBuilderInterface;

class ParamToEquipmentForm extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('allCategory', EntityType::class, [
                'attr' => [
                    'class' => 'searchBox'
                ],
                'class' => Category::class,
                'choice_label' => 'categoryName',
                'placeholder' => 'Wybierz kategorię',
                'required' => false,
                'label' => false
            ])
            ->add('allConstruction', EntityType::class, [
                'attr' => [
                    'class' => 'searchBox'
                ],
                'class' => Construction::class,
                'choice_label' => 'constructionName',
                'placeholder' => 'Wybierz budowę',
                'required' => false,
                'label' => false
            ])
            ->add('recipient', TextType::class, [
                'attr' => [
                    'maxlength' => '30',
                    'class' => 'searchBox'
                ],
                'constraints' => [
                    new Length(['min' => 3])
                ],
                'data' => 'Podaj odbiorcę',
                'required' => false,
                'label' => false,
            ])
            ->add('checkbox', EntityType::class, [
                'class' => Equipment::class,
                'label' => false,
                'choice_label' => false,
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }
}