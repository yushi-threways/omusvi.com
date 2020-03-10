<?php

namespace App\Admin;

use App\DBAL\Types\GenderEnumType;
use App\Entity\BankAccount;
use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

final class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        /** @var User $user */
        $user = $this->getSubject();

        $formMapper
            ->with('ユーザ情報')
            ->add('username', null, [
                'label' => 'ログインID'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'パスワード'],
                'second_options' => ['label' => 'パスワード（再入力）'],
                'required' => false
            ])
            ->add('email', null, [
                'label' => 'メールアドレス'
            ])
            ->add('enabled', null, [
                'label' => '有効化'
            ])
            ->end();


        $formMapper
            ->with('ユーザ詳細情報')
            ->add('userDetail.lastName', null, [
                'label' => '姓'
            ])
            ->add('userDetail.firstName', null, [
                'label' => '名'
            ])
            ->add('userDetail.lastKana', null, [
                'label' => '姓（カナ）'
            ])
            ->add('userDetail.firstKana', null, [
                'label' => '名（カナ）'
            ])
            ->add('userDetail.gender', ChoiceType::class, [
                'label' => '性別',
                'choices' => GenderEnumType::getChoices(),
            ])
            ->add('userDetail.birthday', DateType::class, [
                'label' => '誕生日',
                'input' => 'datetime_immutable',
                'years' => range(1940, 2000),
            ])
            ->add('userDetail.telNumber', null, [
                'label' => '電話番号'
            ])
            ->end();

        if (!$user->getBankAccount()) {
            $user->setBankAccount(new BankAccount());
        }

        $formMapper->with('銀行口座')
            ->add('bankAccount.bankName', null, [
                'label' => '金融機関名'
            ])
            ->add('bankAccount.bankCode', null, [
                'label' => '金融機関コード'
            ])
            ->add('bankAccount.storeName', null, [
                'label' => '支店名'
            ])
            ->add('bankAccount.storeCode', null, [
                'label' => '支店コード'
            ])
            ->add('bankAccount.bankType', ChoiceType::class, [
                'label' => '種別',
                'choices' => [
                    '普通' => '普通',
                    '当座' => '当座',
                    '貯蓄' => '貯蓄',
                ]
            ])
            ->add('bankAccount.accountNumber', null, [
                'label' => '口座番号'
            ])
            ->add('bankAccount.accountName', null, [
                'label' => '講座名義（カタカナ）'
            ])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('username', null, [
                'label' => 'ログインID',
            ])
            ->add('enabled', null, [
                'label' => '有効',
            ])
            ->add('userDetail.gender', null, [
                'label' => '性別'
            ])
            ->add('updatedAt', null, [
                'label' => '最終更新日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('createdAt', null, [
                'label' => '登録日時',
                'format' => 'Y-m-d H:i:s'
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('username', null, [
                'label' => 'ログインID'
            ])
            ->add('email', null, [
                'label' => 'メール'
            ])
            ->add('user.userDetail.gender', null, [
                'label' => '性別'
            ])
            ->add('enabled', null, [
                'label' => '有効'
            ])
            ->add('lastLogin', null, [
                'label' => '最終ログイン日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('updatedAt', null, [
                'label' => '最終更新日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('createdAt', null, [
                'label' => '登録日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('_action', null, [
                'label' => '操作',
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->with('ユーザ')
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('username', null, [
                'label' => 'ログインID'
            ])
            ->add('email', null, [
                'label' => 'メール'
            ])
            ->add('enabled', null, [
                'label' => '有効'
            ])
            ->add('lastLogin', null, [
                'label' => '最終ログイン日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('updatedAt', null, [
                'label' => '最終更新日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('createdAt', null, [
                'label' => '登録日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->end();

        $showMapper
            ->with('ユーザ詳細情報')
            ->add('userDetail.firstName', null, [
                'label' => '名前'
            ])
            ->add('userDetail.lastName', null, [
                'label' => '苗字'
            ])
            ->add('userDetail.gender', null, [
                'label' => '性別'
            ])
            ->add('userDetail.birthday', null, [
                'label' => '生年月日'
            ])
            ->end();
    }
}
