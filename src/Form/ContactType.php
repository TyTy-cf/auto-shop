<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> false,
                'attr'=> [
                    'placeholder' => 'Nom',
                    'aria-label' => 'Nom et prénom',
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> false,
                'attr'=> [
                    'placeholder' => 'Mail',
                    'aria-label' => 'Adresse email',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label'=> false,
                'attr'=> [
                    'placeholder' => 'Votre message',
                    'aria-label' => 'Votre message',
                ]
            ])
            ->add('conditions_acceptation', CheckboxType::class, [
                'label' => "Cocher cette case si vous acceptez les conditions d'utilisation"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
