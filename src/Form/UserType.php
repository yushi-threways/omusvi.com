<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'メールアドレス',
                'attr' => ['placeholder' => 'メールアドレス']
            ])
            // ->add('roles')
            ->add('sex', ChoiceType::class, [
                'choices'  => [
                    '男性' => '1',
                    '女性' => '2',
                ],
                'label' => '性別',
                'placeholder' => '性別を選択してください'
            ])
            ->add('password', RepeatedType::class, array(
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'パスワードを入力してください'],
                'second_options' => ['label' => 'パスワードを再入力してください'],
            ))
            ->add('lastname', null, [
                'label' => '姓',
                'attr' => ['placeholder' => '姓']
            ])
            ->add('firstname', null, [
                'label' => '名',
                'attr' => ['placeholder' => '名']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
