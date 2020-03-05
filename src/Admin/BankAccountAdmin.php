<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class BankAccountAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('user', null, [
                'label' => 'ユーザー'
            ])
            ->add('bankName', null, [
                'label' => '金融機関名'
            ])
            ->add('bankCode', null, [
                'label' => '金融機関コード'
            ])
            ->add('storeName', null, [
                'label' => '店舗名'
            ])
            ->add('storeCode', null, [
                'label' => '店舗コード'
            ])
            ->add('bankType', null, [
                'label' => '金融機関の種別'
            ])
            ->add('accountNumber', null, [
                'label' => '金融機関番号'
            ])
            ->add('accountName', null, [
                'label' => 'アカウント名'
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

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('user', null, [
                'label' => 'ユーザー'
            ])
            ->add('bankName', null, [
                'label' => '金融機関名'
            ])
            ->add('bankCode', null, [
                'label' => '金融機関コード'
            ])
            ->add('storeName', null, [
                'label' => '店舗名'
            ])
            ->add('storeCode', null, [
                'label' => '店舗コード'
            ])
            ->add('bankType', null, [
                'label' => '金融機関の種別'
            ])
            ->add('accountNumber', null, [
                'label' => '金融機関番号'
            ])
            ->add('accountName', null, [
                'label' => 'アカウント名'
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

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('user', null, [
                'label' => 'ユーザー'
            ])
            ->add('bankName', null, [
                'label' => '金融機関名'
            ])
            ->add('bankCode', null, [
                'label' => '金融機関コード'
            ])
            ->add('storeName', null, [
                'label' => '店舗名'
            ])
            ->add('storeCode', null, [
                'label' => '店舗コード'
            ])
            ->add('bankType', null, [
                'label' => '金融機関の種別'
            ])
            ->add('accountNumber', null, [
                'label' => '金融機関番号'
            ])
            ->add('accountName', null, [
                'label' => 'アカウント名'
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->with('金融機関情報')
                ->add('id', null, [
                    'label' => 'ID',
                ])
                ->add('bankName', null, [
                    'label' => '金融機関名'
                ])
                ->add('bankCode', null, [
                    'label' => '金融機関コード'
                ])
                ->add('storeName', null, [
                    'label' => '店舗名'
                ])
                ->add('storeCode', null, [
                    'label' => '店舗コード'
                ])
                ->add('bankType', null, [
                    'label' => '金融機関の種別'
                ])
                ->add('accountNumber', null, [
                    'label' => '金融機関番号'
                ])
                ->add('accountName', null, [
                    'label' => 'アカウント名'
                ])
                ->add('updatedAt', null, [
                    'label' => '最終更新日時',
                    'format' => 'Y-m-d H:i:s'
                ])
                ->add('createdAt', null, [
                    'label' => '登録日時',
                    'format' => 'Y-m-d H:i:s'
                ])
            ->end()
            ->with('ユーザー情報')
                ->add('user.id', null, [
                    'label' => 'ID',
                ])
                ->add('user.email', null, [
                    'label' => 'メール'
                ])
                ->add('user.enabled', null, [
                    'label' => '有効'
                ])
                ->add('user.password', null, [
                    'label' => 'パスワード'
                ])
                ->add('user.lastLogin', null, [
                    'label' => '最終ログイン日時'
                ])
                ->add('user.roles', null, [
                    'label' => '権限'
                ])
                ->add('user.updatedAt', null, [
                    'label' => '最終更新日時',
                    'format' => 'Y-m-d H:i:s'
                ])
                ->add('user.createdAt', null, [
                    'label' => '登録日時',
                    'format' => 'Y-m-d H:i:s'
                ])
            ->end();
    }
}
