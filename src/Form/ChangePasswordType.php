<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled'=> true,
                'label'=> 'Mon adresse mail'
            ])
            ->add('nom', TextType::class, [
                'disabled'=> true,
                'label'=> 'Mon nom'
            ])
            ->add('prenom', TextType::class, [
                'disabled'=> true,
                'label'=> 'Mon prenom'
            ])
            ->add('pseudo', TextType::class, [
                'disabled'=> true,
                'label'=> 'Mon pseudo'
            ])
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label'=> 'Mon mot de passe actuel',
                'attr'=> [
                    'placeholder'=> 'Veuillez saisir votre mot de passe actuel'
                ]
            ])
            ->add('new-password', PasswordType::class, [
                'mapped' => false,
                'label'=> 'Mon nouveau mot de passe',
                'attr' => [
                    'placeholder'=> 'Veuillez saisir votre mot de passe actuel'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre nouveau mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label'=>"Mettre à jour"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
