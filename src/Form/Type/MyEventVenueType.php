<?php

namespace App\Form\Type;

use App\Entity\MyEventVenue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyEventVenueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => '受付会場',
            ])
            ->add('url', UrlType::class, [
                'label' => '会場URL',
            ])
            ->add('map', null, [
                'label' => 'マップ共有',
            ])
            ->add('traffic', TextareaType::class, [
                'label' => 'アクセス',
            ])
            ->add('address', null, [
                'label' => '住所',
            ])
            ->add('prefecture', null, [
                'label' => '地域',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyEventVenue::class,
        ]);
    }
}
