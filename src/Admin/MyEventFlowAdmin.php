<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

final class MyEventFlowAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('myEvent', null, [])
            ->add('startTime', null, [
                'label' => '開始時刻'
            ])
            ->add('endTime', null, [
                'label' => '終了時刻'
            ])
            ->add('title', null, [
                'label' => '見出し'
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
            ->add('myEvent', null, [])
            ->add('startTime', null, [
                'label' => '開始時刻'
            ])
            ->add('endTime', null, [
                'label' => '終了時刻'
            ])
            ->add('title', null, [
                'label' => '見出し'
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
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper->with('スケジュール詳細')
            ->add('startTime', TimeType::class, [
                'label' => '開始時刻',
                'input' => 'string',
                'placeholder' => '',
                'required' => false
            ])
            ->add('endTime', TimeType::class, [
                'label' => '終了時刻',
                'input' => 'string',
                'placeholder' => '',
                'required' => false
            ])
            ->add('title', null, [
                'label' => '見出し',
            ])
            ->add('content', null, [
                'label' => '内容',

            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('startTime', null, [
                'label' => '開始時刻',
            ])
            ->add('endTime', null, [
                'label' => '終了時刻',
            ])
            ->add('title', null, [
                'label' => '見出し'
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
}
