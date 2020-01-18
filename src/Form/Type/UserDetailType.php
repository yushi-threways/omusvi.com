<?php

namespace App\Form\Type;

use App\Entity\UserDetail;
use App\DBAL\Types\GenderEnumType;
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
                'label' => '氏名カナ（姓）',
                'help' => '全角カタカナで入力してください',
            ])
            ->add('lastKana', null, [
                'label' => '氏名カナ（名）',
                'help' => '全角カタカナで入力してください',
            ])
            ->add('gender', ChoiceType::class, [
                'label' => '性別',
                'choices' => GenderEnumType::getChoices(),
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
