<?php

namespace App\Form;

use App\Entity\Jeu;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class JeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,['label'=>'NOM',
                'attr' =>[
                    'placeholder'=>'donnez le nom',
                    'class'=>'nom'
                ]

            ])

            ->add('categorie',TextType::class,['label'=>'CATEGORIE ',
                'attr' =>[
                    'placeholder'=>' donnez la CATEGORIE',
                    'class'=>'categorie'
                ]

            ])

            ->add('description',TextType::class,['label'=>'DESCRIPTION ',
                'attr' =>[
                    'placeholder'=>'donnez la description',
                    'class'=>'description'
                ]

            ])


            ->add('image', FileType::class, array('data_class' => null))


            ->add('ajouter',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
        ]);
    }
}
