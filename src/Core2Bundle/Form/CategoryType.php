<?php

namespace Core2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', null, [
                    'label' => 'Désignation',
                    'label_attr' => [
                        'class' => "col-sm-2 control-label",
                    ],
                    'attr' => [
                        'maxlength' => 20,
                        'class' => "form-control",
                        'placeholder' => "Nom de la catégorie"
                    ],
        ]);
    }

/**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Core2Bundle\Entity\Category'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'core2bundle_category';
    }

}
