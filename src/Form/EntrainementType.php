<?php

namespace App\Form;

use App\Entity\Entrainement;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class EntrainementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomJeu',TextType::class,['label'=>'Name of the game',
                'attr' =>[
                    'placeholder'=>'NAME OF THE GAME',
                    'class'=>'nomJeu'
                ]

            ])

            ->add('nomCoach',TextType::class,['label'=>'Name of the coach ',
                'attr' =>[
                    'placeholder'=>'NAME OF THE COACH',
                    'class'=>'nomCoach'
                ]

            ])

            ->add('nomMembre',TextType::class,['label'=>'Name of the membre ',
                'attr' =>[
                    'placeholder'=>'YOUR NAME',
                    'class'=>'nomMembre'
                ]

            ])


            ->add('telephone',TextType::class,['label'=>'Number of the phone ',
                'attr' =>[
                    'placeholder'=>'PHONE',
                    'class'=>'telephone'
                ]

            ])


            ->add('description',TextType::class,['label'=>'Description',
                'attr' =>[
                    'placeholder'=>'DESCRIPTION',
                    'class'=>'description'
                ]

            ])








            ->add('ajouter',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entrainement::class,
        ]);
    }
}
