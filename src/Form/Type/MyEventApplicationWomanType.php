<?php

namespace App\Form\Type;

use App\Entity\MyEventApplication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MyEventApplicationWomanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('womanCount', ChoiceType::class, [
                'label' => '参加人数',
                'choices'  => [
                    '0人' => 0,
                    '1人' => 1,
                    '2人' => 2,
                    '3人' => 3,
                    '4人' => 4,
                    '5人' => 5,
                    '6人' => 6,
                ],            
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
