<?php

namespace App\Admin;

use App\Entity\User;
use App\Entity\BankAccount;
use App\DBAL\Types\GenderEnumType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

final class UserDetailAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        /** @var User $user */
        $user = $this->getSubject();

        $formMapper
            ->add('lastName', null, [
                'label' => '姓'
            ])
            ->add('firstName', null, [
                'label' => '名'
            ])
            ->add('lastKana', null, [
                'label' => '姓（カナ）'
            ])
            ->add('firstKana', null, [
                'label' => '名（カナ）'
            ])
            ->add('gender', ChoiceType::class, [
                'label' => '性別',
                'choices' => GenderEnumType::getChoices(),
            ])
            ->add('birthday', DateType::class, [
                'label' => '誕生日',
                'input' => 'datetime_immutable',
                'years' => range(1940, 2000),
            ])
            ->add('telNumber', null, [
                'label' => '電話番号'
            ])
            ->add('user', ModelListType::class, [
                'label' => 'ユーザー',
                'btn_add' => false,
                'btn_delete' => false,
                'btn_edit' => false,
            ])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('lastName', null, [
                'label' => '姓'
            ])
            ->add('firstName', null, [
                'label' => '名'
            ])
            ->add('lastKana', null, [
                'label' => '姓（カナ）'
            ])
            ->add('firstKana', null, [
                'label' => '名（カナ）'
            ])
            ->add('gender', null, [
                'label' => '性別',
            ])
            ->add('birthday', null, [
                'label' => '誕生日',
            ])
            ->add('telNumber', null, [
                'label' => '電話番号'
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('lastName', null, [
                'label' => '姓'
            ])
            ->add('firstName', null, [
                'label' => '名'
            ])
            ->add('lastKana', null, [
                'label' => '姓（カナ）'
            ])
            ->add('firstKana', null, [
                'label' => '名（カナ）'
            ])
            ->add('gender', null, [
                'label' => '性別',
            ])
            ->add('birthday', null, [
                'label' => '誕生日',
            ])
            ->add('telNumber', null, [
                'label' => '電話番号'
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

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('lastName', null, [
                'label' => '姓'
            ])
            ->add('firstName', null, [
                'label' => '名'
            ])
            ->add('lastKana', null, [
                'label' => '姓（カナ）'
            ])
            ->add('firstKana', null, [
                'label' => '名（カナ）'
            ])
            ->add('gender', null, [
                'label' => '性別',
            ])
            ->add('birthday', null, [
                'label' => '誕生日',
            ])
            ->add('telNumber', null, [
                'label' => '電話番号'
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
