<?php

namespace App\Form\Type;

use App\Entity\UserDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;



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
                'label' => '氏名ｶﾅ（姓）',
                'help' => '半角ｶﾀｶﾅで入力してください',
            ])
            ->add('lastKana', null, [
                'label' => '氏名ｶﾅ（名）',
                'help' => '半角ｶﾀｶﾅで入力してください',
            ])
            ->add('sex', ChoiceType::class, [
                'label' => '性別',
                'choices' => [
                    "男性" => 0,
                    "女性" => 1,
                ],
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => '生年月日',
            ])
            ->add('telNumber', null, [
                'label' => '電話番号',
                'help' => 'ハイフンなしで入力してください',
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
