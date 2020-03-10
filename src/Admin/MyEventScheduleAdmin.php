<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\MyEventApplication;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

final class MyEventScheduleAdmin extends AbstractAdmin
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
            ->add('eventDay', null, [
                'label' => 'イベント日',
                'format' => 'Y-m-d'

            ])
            ->add('womanLimit', null, [
                'label' => '女性制限数'
            ])
            ->add('manLimit', null, [
                'label' => '男性制限数'
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
            ->add('eventDay', null, [
                'label' => 'イベント日',
                'format' => 'Y-m-d'
            ])
            ->add('womanLimit', null, [
                'label' => '女性制限数'
            ])
            ->add('manLimit', null, [
                'label' => '男性制限数'
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
            ->add('myEvent', ModelListType::class, [
                'label' => 'イベント',
                'btn_add' => false,
                'btn_delete' => false,
                'btn_edit' => false,
            ])
            ->add('startTime', TimeType::class, [
                'label' => '開始時刻',
                'placeholder' => '',
            ])
            ->add('eventDay', DateType::class, [
                'label' => 'イベント日',
                'input' => 'datetime_immutable'
            ])
            ->add('womanLimit', NumberType::class, [
                'label' => '女性制限数'
            ])
            ->add('manLimit', NumberType::class, [
                'label' => '男性制限数'
            ])
            ->add('manTerms', null, [
                'label' => '男性条件'
            ])
            ->add('womanTerms', null, [
                'label' => '女性条件'
            ])
            ->add('textTerms', null, [
                'label' => 'イベント条件',
                'required' => false
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('myEvent', null, [])
            ->add('startTime', null, [
                'label' => '開始時刻',
            ])
            ->add('eventDay', null, [
                'label' => 'イベント日',
                'format' => 'Y-m-d'

            ])
            ->add('womanLimit', NumberType::class, [
                'label' => '女性制限数'
            ])
            ->add('manLimit', NumberType::class, [
                'label' => '男性制限数'
            ])
            ->add('manTerms', null, [
                'label' => '男性条件'
            ])
            ->add('womanTerms', null, [
                'label' => '女性条件'
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
            ->with('申し込み状況')
            ->add('myEventApplications', null, [
                'label' => '申込内容',
                'template' => 'admin/my_event_application/sonata_show.html.twig',
            ])
            ->end();
    }
}
