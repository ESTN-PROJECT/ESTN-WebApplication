<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;
use Symfony\Component\Validator\Constraints\Valid;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, array('label' => false, 'attr' => ['placeholder' => 'Enter your email']))
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
                'label' => 'Pick your city :'
            ])
            ->add('rank', ChoiceType::class, [
                'choices' => [
                    'Iron' => 'Iron',
                    'Bronze' => 'Bronze',
                    'Silver' => 'Silver',
                    'Gold' => 'Gold',
                    'Platinum' => 'Platinum',
                ],
                'label' => 'Pick your rank :'
            ])
            ->add('username', null, array('label' => false, 'attr' => ['placeholder' => 'Enter your username ']))
            ->add('agreeTerms', CheckboxType::class, [

                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,


                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => ['placeholder' => 'Enter your password ']
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => User::ROLES,
                'multiple'  => true,
                'expanded' => true,
                'required' => true,
                'label' => false,
            ])
            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ExampleCaptchaUserRegistration',
                'constraints' => [
                    new ValidCaptcha([
                        'message' => 'Invalid captcha, please try again',
                    ]),
                ],
                'label' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
