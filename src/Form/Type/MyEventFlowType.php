<?php

namespace App\Form\Type;

use App\Entity\MyEventFlow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;


class MyEventFlowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startTime', TimeType::class, [
                'label' => '開始時間',
                'widget' => 'choice',
                'input' => 'datetime_immutable',
                'required' => false,
            ])
            ->add('endTime', TimeType::class, [
                'label' => '終了時間',
                'widget' => 'choice',
                'input' => 'datetime_immutable',
                'required' => false,
            ])
            ->add('title', null, [
                'label' => '見出し',
            ])
            ->add('content', null, [
                'label' => '内容',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyEventFlow::class,
        ]);
    }
}
