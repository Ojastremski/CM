<?php

namespace CM\ConstructionBundle\Form\Type;

use Utils\MomentFormatConverter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimePickerType extends AbstractType
{
    private $formatConverter;
    
    public function __construct()
    {
        $this->formatConverter = new MomentFormatConverter();
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['attr']['data-date-format'] = $this->formatConverter->convert($options['format']);
        $view->vars['attr']['data-date-locale'] = mb_strtolower(str_replace('_', '-', \Locale::getDefault()));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'widget' => 'single_text',
            // if true, the browser will display the native date picker widget
            // however, this app uses a custom JavaScript widget, so it must be set to false
            'html5' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return DateTimeType::class;
    }
}