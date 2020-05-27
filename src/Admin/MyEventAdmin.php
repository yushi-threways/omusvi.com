<?php

namespace App\Admin;

use App\Entity\MyEvent;
use Sonata\DoctrineORMAdminBundle\Filter\DateFilter;
use Sonata\DoctrineORMAdminBundle\Filter\DateTimeFilter;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

final class MyEventAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        /** @var MyEvent $my_event */
        $my_event = $this->getSubject();

        $hasImage = (bool) $my_event->getImageName();

        $formMapper
            ->with('イベント情報')
            ->add('name', null, [
                'label' => 'イベント名'
            ])
            ->add('description', null, [
                'label' => 'イベント概要'
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'イベント内容',
                'config_name' => 'my_config',
            ])
            ->add('startAt', null, [
                'label' => '開始日時'
            ])
            ->add('endAt', null, [
                'label' => '終了日時'
            ])
            ->add('maleSeats', null, [
                'label' => '男性募集人数'
            ])
            ->add('femaleSeats', null, [
                'label' => '女性募集人数'
            ])
            ->add('maleAgeLower', null, [
                'label' => '参加可能年齢下限（男性）'
            ])
            ->add('maleAgeUpper', null, [
                'label' => '参加可能年齢上限（男性）'
            ])
            ->add('femaleAgeLower', null, [
                'label' => '参加可能年齢下限（女性）'
            ])
            ->add('femaleAgeUpper', null, [
                'label' => '参加可能年齢上限（女性）'
            ])
            ->add('menPrice', null, [
                'label' => '男性料金'
            ])
            ->add('womanPrice', null, [
                'label' => '女性料金'
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'イベント画像',
                'required' => !$hasImage,
            ])
            ->end();

        $formMapper
            ->with('イベントの流れ')
            ->add('myEventFlows', CollectionType::class, [
                'by_reference' => false,
                // 'type_options' => [
                //     'delete' => true,
                // ]
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ])
            ->end();

        $formMapper
            ->with('イベント場所')
            ->add('myEventVenue', ModelListType::class, [
                'label' => 'イベント会場',
                'btn_add' => false,
                'btn_delete' => false,
                'btn_edit' => false,
            ])
            ->end();

        $formMapper
            ->with('イベントタグ')
            ->add('tags', null, [
                'expanded' => true,
            ])
            ->end();

        $formMapper
            ->with('公開状況')
            ->add('published', null, [
                'label' => '公開'
            ])
            ->end();

        // $formMapper
        //     ->with('イベント日程')
        //     ->add('myEventSchedule.manLimit', NumberType::class, [
        //         'label' =>  '男性最大数'
        //     ])
        //     ->add('myEventSchedule.womanLimit', NumberType::class, [
        //         'label' =>  '女性最大数'
        //     ])
        //     ->add('myEventSchedule.manTerms', null, [
        //         'label' =>  '男性条件'
        //     ])
        //     ->add('myEventSchedule.womanTerms', null, [
        //         'label' =>  '女性条件'
        //     ])
        //     ->add('myEventSchedule.textTerms', null, [
        //         'label' =>  '参加条件'
        //     ])
        //     ->add('myEventSchedule.startTime', TimeType::class, [
        //         'label' =>  '開始時間',
        //         'input' => 'datetime_immutable',
        //     ])
        //     ->add('myEventSchedule.evnetDay', DateType::class, [
        //         'label' =>  '開催日',
        //         'input' => 'datetime_immutable',
        //     ])
        //     ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => 'イベント名',
            ])
            ->add('myEventVenue', null, [
                'label' => 'イベント会場',
            ])
             ->add('myEventSchedule.eventDay', DateFilter::class, [
                 'label' =>  '開催日',
                 'input' => 'datetime_immutable'
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
                'label' => '公開状況',
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('name', null, [
                'label' => 'イベント名'
            ])
            ->add('myEventVenue', null, [
                'label' => 'イベント会場',
            ])
            ->add('myEventSchedule', null, [
                'label' =>  '開催日',
                'format' => 'Y-m-d'
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
                'label' => '公開状況',
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
                'label' => 'イベント名'
            ])
            ->add('description', null, [
                'label' => 'イベント概要'
            ])
            ->add('content', null, [
                'label' => 'イベント内容',
            ])
            ->add('startAt', null, [
                'label' => '開始日時'
            ])
            ->add('endAt', null, [
                'label' => '終了日時'
            ])
            ->add('maleSeats', null, [
                'label' => '男性募集人数'
            ])
            ->add('femaleSeats', null, [
                'label' => '女性募集人数'
            ])
            ->add('maleAgeLower', null, [
                'label' => '参加可能年齢下限（男性）'
            ])
            ->add('maleAgeUpper', null, [
                'label' => '参加可能年齢上限（男性）'
            ])
            ->add('femaleAgeLower', null, [
                'label' => '参加可能年齢下限（女性）'
            ])
            ->add('femaleAgeUpper', null, [
                'label' => '参加可能年齢上限（女性）'
            ])
            ->add('menPrice', null, [
                'label' => '男性料金'
            ])
            ->add('womanPrice', null, [
                'label' => '女性料金'
            ])
            ->add('imageFile', null, [
                'label' => 'イベント画像',
            ])
            ->end();

        $showMapper
            ->with('イベント場所')
            ->add('myEventVenue', null, [
                'label' => 'イベント会場',
            ])
            ->end();

        $showMapper
            ->with('イベントタグ')
            ->add('tags', null, [
                'label' => 'タグ'
            ])
            ->end();

        $showMapper
            ->with('イベント日程')
            ->add('myEventSchedule.manLimit', null, [
                'label' =>  '男性最大数'
            ])
            ->add('myEventSchedule.womanLimit', null, [
                'label' =>  '女性最大数'
            ])
            ->add('myEventSchedule.manTerms', null, [
                'label' =>  '男性条件'
            ])
            ->add('myEventSchedule.womanTerms', null, [
                'label' =>  '女性条件'
            ])
            ->add('myEventSchedule.textTerms', null, [
                'label' =>  '参加条件'
            ])
            ->add('myEventSchedule.startTime', null, [
                'label' =>  '開始時間',
                'format' => 'H:i:s'

            ])
            ->add('myEventSchedule.eventDay', null, [
                'label' =>  '開催日',
                'format' => 'Y-m-d'

            ])
            ->end();

        $showMapper
            ->with('公開状況')
            ->add('publishes', null, [
                'label' => '公開状況',
            ])
            ->end();
    }
}
