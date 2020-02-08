<?php

namespace App\Form\Type;

use App\Entity\BankAccount;
use function Symfony\Component\DependencyInjection\Tests\Fixtures\factoryFunction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class BankAccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bankName', null, [
                'label' => '金融機関名',
                'required' => true,
                'empty_data' => '',
            ])
            ->add('bankCode', null, [
                'label' => '金融機関コード',
                'required' => true,
                'empty_data' => '',
            ])
            ->add('storeName', null, [
                'label' => '支店名',
                'required' => true,
                'empty_data' => '',
            ])
            ->add('storeCode', null, [
                'label' => '支店コード',
                'required' => true,
                'empty_data' => '',
            ])
            ->add('bankType', ChoiceType::class, [
                'label' => '種別',
                'required' => true,
                'choices'  => [
                    '普通' => '普通',
                    '当座' => '当座',
                    '貯蓄' => '貯蓄',
                ],
                'empty_data' => '',
            ])
            ->add('accountNumber', null, [
                'label' => '口座番号',
                'required' => true,
                'empty_data' => '',
            ])
            ->add('accountName', null, [
                'label' => '講座名義（カタカナ）',
                'required' => true,
                'empty_data' => '',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BankAccount::class,
        ]);
    }
}
