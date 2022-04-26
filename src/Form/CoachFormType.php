<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoachFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('email', EmailType::class)
            ->add('username')
            ->add('ville', ChoiceType::class, [
                'choices' => [
                    'Mahdia' => 'Mahdia',
                    'Sousse' => 'Sousse',
                    'Monastir' => 'Monastir',
                    'Tunis' => 'Tunis',
                    'Ariana' => 'Ariana',
                    'Ben Arous' => 'Ben Arous',
                    'Mannouba' => 'Mannouba',
                    'Bizerte' => 'Bizerte',
                    'Nabeul' => 'Nabeul',
                    'Béja' => 'Béja',
                    'Jendouba' => 'Jendouba',
                    'Zaghouan' => 'Zaghouan',
                    'Siliana' => 'Siliana',
                    'Kef' => 'Kef',
                    'Kasserine' => 'Kasserine',
                    'Sidi Bouzid' => 'Sidi Bouzid',
                    'Kairouan' => 'Kairouan',
                    'Gafsa' => 'Gafsa',
                    'Sfax' => 'Sfax',
                    'Gabès' => 'Gabès',
                    'Médenine' => 'Médenine',
                    'Tozeur' => 'Tozeur',
                    'Kebili' => 'Kebili',
                    'Tataouine' => 'Tataouine',


                ],
                'label' => 'Pick your city  :  '
            ])
            ->add('description')
            ->add('cout')
            ->add('rank', ChoiceType::class, [
                'choices' => [
                    'Iron' => 'Iron',
                    'Bronze' => 'Bronze',
                    'Silver' => 'Silver',
                    'Gold' => 'Gold',
                    'Platinum' => 'Platinum',
                ],
                'label' => 'Pick your rank  :  '
            ]);







    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
