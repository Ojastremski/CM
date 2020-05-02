<?php

namespace CM\ConstructionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategoryForm extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoryName', TextType::class, [
                'attr' => [
                    'autofocus' => true,
                    'maxlength' => '20'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
                'label' => 'Nazwa kategorii*'
            ])
            ->add('active', ChoiceType::class, [
                'choices'  => [
                    'Tak' => '1',
                    'Nie' => '0'
                ],
                'label' => 'Widoczność'
            ])
        ;

        $builder->get('active')
            ->addModelTransformer(new CallbackTransformer(
                function ($property) {
                    return (string) $property;
                },
                function ($property) {
                    return (bool) $property;
                }
        ));
    }
}