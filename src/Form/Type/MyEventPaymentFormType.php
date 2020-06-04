<?php

namespace App\Form\Type;

use App\Entity\MyEventApplication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\DBAL\Types\MyEventApplicationPayMentEnumType;

class MyEventPaymentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paymentType', ChoiceType::class, [
                'label' => false,
                'choices' => MyEventApplicationPayMentEnumType::getChoices(),
                'expanded' => true,
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyEventApplication::class,
        ]);
    }
}
