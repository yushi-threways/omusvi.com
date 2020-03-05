<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class TagAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('name', null, [
                'label' => 'ログインID'
            ])
            ->end()
        ;
        


    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => 'タグ名',
            ])
//            ->add('updatedAt', null, [
//                'label' => '最終更新日時',
//                'format' => 'Y-m-d H:i:s'
//            ])
//            ->add('createdAt', null, [
//                'label' => '登録日時',
//                'format' => 'Y-m-d H:i:s'
//            ])
            ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => 'タグ名'
            ])
//            ->add('updatedAt', null, [
//                'label' => '最終更新日時',
//                'format' => 'Y-m-d H:i:s'
//            ])
//            ->add('createdAt', null, [
//                'label' => '登録日時',
//                'format' => 'Y-m-d H:i:s'
//            ])
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
                'label' => 'タグ名'
            ])
        ;
    }
}