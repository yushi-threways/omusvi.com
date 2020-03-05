<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class PrefectureAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => '都道府県名'
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

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => '都道府県名'
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
            ->add('name', null, [
                'label' => '都道府県名'
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => '都道府県名'
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
}
