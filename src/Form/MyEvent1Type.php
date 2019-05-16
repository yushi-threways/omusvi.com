<?php

namespace App\Form;

use App\Entity\MyEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyEvent1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('start_date')
            ->add('start_time')
            ->add('end_date')
            ->add('end_time')
            ->add('content')
            ->add('address')
            ->add('traffic')
            ->add('contact')
            ->add('tel')
            ->add('shop_name')
            ->add('men_old')
            ->add('woman_old')
            ->add('createdAt')
            ->add('modifiedAt')
            ->add('image')
            ->add('imageSize')
            ->add('men_remit')
            ->add('woman_remit')
            ->add('men_price')
            ->add('woman_price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyEvent::class,
        ]);
    }
}
