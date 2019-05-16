<?php

namespace App\Form;

use App\Entity\Flow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_time', null, [
                'label' => '開始時間',
                'attr' => ['placeholder' => '開始時間を入力してください']  
            ])
            ->add('title', null, [
                'label' => 'タイトル',
                'attr' => ['placeholder' => 'タイトルを入力してください']  
            ])
            ->add('content', null, [
                'label' => '内容',
                'attr' => ['placeholder' => '内容を入力してください']  
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flow::class,
        ]);
    }
}
