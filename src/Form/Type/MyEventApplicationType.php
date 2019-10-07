<?php

namespace App\Form\Type;

use App\Entity\MyEventApplication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyEventApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menCount', null, [
                'label' => '人数',
                'empty_data' => 0,
            ])
            ->add('womanCount', null, [
                'label' => '人数',
                'empty_data' => 0,
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
