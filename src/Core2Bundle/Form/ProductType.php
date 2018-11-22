<?php

namespace Core2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//Jointure avec la CATEGORY
use Core2Bundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
//        add(nom, type, option)
        $builder
                ->add('name', null, [
                    'label' => "Nom",
                    'label_attr' => [
                        'class' => "col-sm-2 control-label",
                        'for' => "nom"
//                        'OnClick' => "test()",
//                        'style' => "color:red"
                    ],
                    'attr' => [
                        'maxlength' => 10,
                        'class' => "form-control",
                        'placeholder' => "Nom du produit"
                    ],
//                    'required' => false
//            orm : nullable true
                ])
                ->add('price', null, [
                    'label' => "Prix",
                    'label_attr' => [
                        'class' => "col-sm-2 control-label",
                    ],
                    'attr' => [
                        'class' => "form-control",
                        'placeholder' => "Prix",
                        'style' => 'text-align:right'
                    ],
//                    'required' => false
                ])
                ->add('qte', null, [
                    'label' => "Quantité",
                    'label_attr' => [
                        'class' => "col-sm-2 control-label",
                    ],
                    'attr' => [
                        'class' => "form-control",
                        'placeholder' => "Quantité",
                        'style' => 'text-align:right'
                    ],
//                    'required' => false
                ])
                ->add('categorie', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->orderBy('u.name', 'ASC');
                    },
                    'label' => "Catégorie",
                    'label_attr' => [
                        'class' => "col-sm-2 control-label",
                    ],
                    'attr' => [
                        'class' => "form-control"
                    ]
                ])

                ->add('test', null, [
                    'label' => "Test",
                    'label_attr' => [
                        'class' => "col-sm-2 control-label",
                    ],
                    'attr' => [
                        'class' => "form-control",
                        'placeholder' => "n'existe pas dans l'entité"
                    ],
                    'mapped' => false
//                    créer un champ n exist pas dans entité

        ])
            ->add('file', FileType::class, array('label' => 'image'))
        ;
//        categorie : nom de relation dans fichier orm
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Core2Bundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'core2bundle_product';
    }

}
