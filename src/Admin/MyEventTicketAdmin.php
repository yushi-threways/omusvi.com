<?php

declare(strict_types=1);

namespace App\Admin;

use App\DBAL\Types\GenderEnumType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class MyEventTicketAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('myEvent', null, [])
            ->add('discount', null, [])
            ->add('gender', null, [
                'label' => '性別'
            ])
            ->add('numberUnit', null, [
                'label' => '単位'
            ])
            ->add('price', null, [
                'label' => '金額'
            ])
            ->add('sales', null, [
                'label' => '販売実績'
            ])
            ->add('limitSheets', null, [
                'label' => '枚数'
            ])
            ->add('published', null, [
                'label' => '販売中'
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
            ->add('discount', null, [])
            ->add('gender', null, [
                'label' => '性別'
            ])
            ->add('numberUnit', null, [
                'label' => '単位'
            ])
            ->add('price', null, [
                'label' => '金額'
            ])
            ->add('sales', null, [
                'label' => '販売実績'
            ])
            ->add('limitSheets', null, [
                'label' => '枚数'
            ])
            ->add('published', null, [
                'label' => '販売中'
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
        ->add('discount', null, [])
        ->add('gender', ChoiceType::class, [
            'label' => '性別',
            'choices' => GenderEnumType::getChoices(),
        ])
        ->add('numberUnit', null, [
            'label' => '単位（人）'
        ])
        ->add('price', null, [
            'label' => '金額'
        ])
        ->add('limitSheets', null, [
            'label' => '枚数'
        ])
        ->add('published', null, [
            'label' => '販売中'
        ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('gender', null, [
                'label' => '性別'
            ])
            ->add('numberUnit', null, [
                'label' => '単位'
            ])
            ->add('price', null, [
                'label' => '金額'
            ])
            ->add('sales', null, [
                'label' => '販売実績'
            ])
            ->add('limitSheets', null, [
                'label' => '枚数'
            ])
            ->add('published', null, [
                'label' => '販売中'
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
