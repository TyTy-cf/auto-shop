<?php


namespace App\Form\Filters;


use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\TextFilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextFilterType::class, [
            'condition_pattern' => FilterOperands::STRING_CONTAINS,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection'   => false,
            'validation_groups' => array('filtering'),
        ]);
    }
}
