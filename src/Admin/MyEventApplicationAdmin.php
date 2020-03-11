<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\MyEventApplication;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


final class MyEventApplicationAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('myEventSchedule', null, [
                'label' => 'イベントスケジュール'
            ])
            ->add('user', null, [
                'label' => 'ユーザー'
            ])
            ->add('status', null, [
                'label' => 'ステータス'
            ])
            ->add('womanCount', null, [
                'label' => '女性応募数'
            ])
            ->add('menCount', null, [
                'label' => '男性応募数'
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
            ->add('myEventSchedule', null, [
                'label' => 'イベントスケジュール'
            ])
            ->add('user', null, [
                'label' => 'ユーザー'
            ])
            ->add('status', null, [
                'label' => 'ステータス'
            ])
            ->add('womanCount', null, [
                'label' => '女性応募数'
            ])
            ->add('menCount', null, [
                'label' => '男性応募数'
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
                    'paied' => [],
                    'reject' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper->with('スケジュール詳細')
            ->add('myEventSchedule', ModelListType::class, [
                'label' => 'イベントスケジュール',
                'btn_add' => false,
                'btn_delete' => false,
                'btn_edit' => false,
            ])
            ->add('user', ModelListType::class, [
                'label' => 'ユーザー',
                'btn_add' => false,
                'btn_delete' => false,
                'btn_edit' => false,
            ])
            ->add('status', null, [
                'label' => 'ステータス'
            ])
            ->add('womanCount', NumberType::class, [
                'label' => '女性応募数'
            ])
            ->add('menCount', NumberType::class, [
                'label' => '男性応募数'
            ])
            ->add('cancelled', null, [
                'label' => 'キャンセル',
                'required' => false
            ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('myEventSchedule', null, [
                'label' => 'イベントスケジュール'
            ])
            ->add('user', null, [
                'label' => 'ユーザー'
            ])
            ->add('status', null, [
                'label' => 'ステータス'
            ])
            ->add('womanCount', null, [
                'label' => '女性応募数'
            ])
            ->add('menCount', null, [
                'label' => '男性応募数'
            ])
            ->add('cancelled', null, [
                'label' => 'キャンセル'
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

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('paied', $this->getRouterIdParameter().'/paied');
        $collection->add('reject', $this->getRouterIdParameter().'/reject');
    }

    public function checkAccess($action, $object = null)
    {

        switch ($action) {
            case 'paied':
                return $this->isAcceptable($object);
            case 'reject':
                return $this->isRejectable($object);
        }

        return parent::checkAccess($action, $object);
    }

    private function isAcceptable(MyEventApplication $application)
    {
        return $this->isGranted("ADMIN") &&
        $application->isPaied();
    }
    
    private function isRejectable(MyEventApplication $application)
    {
        return $this->isGranted("ADMIN") &&
        $application->isApplied() || $application->isPaied() || $application->isAccepted();
    }
}
