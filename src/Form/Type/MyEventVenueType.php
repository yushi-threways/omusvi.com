<?php

namespace App\Form\Type;

use App\Entity\MyEventVenue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyEventVenueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('map')
            ->add('traffic')
            ->add('address')
            ->add('prefecture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyEventVenue::class,
        ]);
    }
}
