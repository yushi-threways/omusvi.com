<?php

namespace App\Form\Type;

use App\Entity\MyEventSchedule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class MyEventScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('womanLimit', null, [
                'label' => '女性参加人数',
            ])
            ->add('manLimit', null, [
                'label' => '男性参加人数',
            ])
            ->add('womanTerms', null, [
                'label' => '女性参加条件',
            ])
            ->add('manTerms', null, [
                'label' => '男性参加条件',
            ])
            ->add('textTerms', null, [
                'label' => '参加条件',
            ])
            ->add('startTime', DateType::class, [
                'label' => 'イベント開始日時',
                'widget' => 'choice',
                'input' => 'datetime_immutable',
            ])     
            ->add('eventDay', DateType::class, [
                'label' => 'イベント開催日',
                'widget' => 'choice',
                'input' => 'datetime_immutable',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyEventSchedule::class,
        ]);
    }
}
