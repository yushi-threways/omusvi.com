<?php

namespace App\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;

final class MyEventVenueAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('name', null, [
                'label' => '会場名'
            ])
            ->add('map', null, [
                'label' => 'マップ'
            ])
            ->add('traffic', null, [
                'label' => '交通手段'
            ])
            ->add('url', null, [
                'label' => 'サイトurl'
            ])
            ->add('prefecture', ModelListType::class, [
                'label' => '都道府県',
                'btn_add' => false,
                'btn_delete' => false,
                'btn_edit' => false,
            ])
            ->add('address', null, [
                'label' => '住所'
            ])
            ->with('公開状況')
                 ->add('published', null, [
                     'label' => '公開'
                 ])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => '会場名',
            ])
            ->add('updatedAt', null, [
                'label' => '最終更新日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('createdAt', null, [
                'label' => '登録日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('published', null, [
                'label' => '公開'
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => '会場名'
            ])
            ->add('url', null, [
                'label' => 'サイトurl'
            ])
            ->add('address', null, [
                'label' => '住所'
            ])
            ->add('updatedAt', null, [
                'label' => '最終更新日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('createdAt', null, [
                'label' => '登録日時',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('published', null, [
                'label' => '公開'
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
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => '会場名'
            ])
            ->add('map', null, [
                'label' => 'マップ'
            ])
            ->add('published', null, [
                'label' => '公開'
            ])
            // ->add('traffic', null, [
            //     'label' => '交通手段'
            // ])
            // ->add('url', null, [
            //     'label' => 'サイトurl'
            // ])
            // ->add('address', null, [
            //     'label' => '住所'
            // ])
            // ->add('prefecture', null, [
            //     'label' => '都道府県'
            // ])
        ;
    }
}
