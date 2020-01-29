<?php

namespace App\Form\Type;

use App\Entity\Prefecture;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Model\SearchFilter\EventSearchFilter;


class MyEventSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'label' => 'イベントタグ',
                'placeholder' => '指定なし',
                'required' => false,
            ])
            // ->add('prefecture', EntityType::class, [
            //     'class' => Prefecture::class,
            //     'label' => '地域',
            //     'placeholder' => '指定なし',
            //     'required' => false,
            // ])
            ->add('startDate', DateType::class, [
                'label' => "イベント日",
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('endDate', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('eventTimeZone', ChoiceType::class, [
                'label' => "イベント時間",
                'placeholder' => '指定なし',
                'choices' => [
                    '昼' => 'day_time',
                    '夜' => 'night_time',
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => false,
            ])
    ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EventSearchFilter::class,
        ]);
    }
}
