<?php

declare(strict_types=1);

namespace App\Admin;

use App\DBAL\Types\RateEnumType;
use App\DBAL\Types\GenderEnumType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class DiscountAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('title', null, [
                'label' => 'タイトル'
            ])
            ->add('summary', null, [
                'label' => '内容'
            ])
            ->add('myEventTickets', null, [
                'label' => 'チケット'
            ])
            ->add('type', null, [
                'label' => '割引タイプ'
            ])
            ->add('discountedPrice', null, [
                'label' => '割引価格'
            ])
            ->add('endAt', null, [
                'label' => '割引期間'
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
            ->add('title', null, [
                'label' => 'タイトル'
            ])
            ->add('summary', null, [
                'label' => '内容'
            ])
            ->add('myEventTickets', null, [
                'label' => 'チケット'
            ])
            ->add('type', null, [
                'label' => '割引タイプ'
            ])
            ->add('discountedPrice', null, [
                'label' => '割引価格'
            ])
            ->add('endAt', null, [
                'label' => '割引期間'
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
        $formMapper->with('チケット')
        ->add('title', null, [
            'label' => 'タイトル'
        ])
        ->add('summary', null, [
            'label' => '内容'
        ])
        ->add('type', ChoiceType::class, [
            'label' => '割引タイプ',
            'choices' => RateEnumType::getChoices(),
        ])
        ->add('discountedPrice', null, [
            'label' => '割引価格'
        ])
        ->add('endAt', null, [
            'label' => '割引期間'
        ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('title', null, [
                'label' => 'タイトル'
            ])
            ->add('summary', null, [
                'label' => '内容'
            ])
            ->add('myEventTickets', CollectionType::class, [
                'label' => 'チケット'
            ])
            ->add('type', null, [
                'label' => '割引タイプ'
            ])
            ->add('discountedPrice', null, [
                'label' => '割引価格'
            ])
            ->add('endAt', null, [
                'label' => '割引期間'
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
