<?php

namespace App\Form\Type;

use App\Entity\UserDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
                'label' => '氏名(性)',
            ])
            ->add('lastName', null, [
                'label' => '氏名（名）',
            ])
            ->add('firstKana', null, [
                'label' => '氏名カナ（姓）',
            ])
            ->add('lastKana', null, [
                'label' => '氏名カナ（名）',
            ])
            ->add('sex', null, [
                'label' => '性別',
                'choices' => [
                    // :todo 値とラベルのマッピング
                    "男性" => 0,
                    "女性" => 1,
                ],
            ])
            ->add('telNumber', null, [
                'label' => '電話番号',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserDetail::class,
        ]);
    }
}
