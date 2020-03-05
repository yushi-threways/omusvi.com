<?php

namespace App\Admin;

use App\Security\Manager\AdminManager;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class AdminAdmin extends AbstractAdmin
{
    /**
     * @var AdminManager
     */
    private $adminManager;

    public function __construct(string $code, string $class, string $baseControllerName, AdminManager $adminManager)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->adminManager = $adminManager;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', null, ['label' => 'ログインID']);

        if ($this->isCurrentRoute('create')) {
            $formMapper->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'パスワード'],
                'second_options' => ['label' => 'パスワード（再入力）'],
                'required' => true
            ]);
        }

        if ($this->isCurrentRoute('edit')) {
            $formMapper->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'パスワード'],
                'second_options' => ['label' => 'パスワード（再入力）'],
                'required' => false
            ]);
        }

        $formMapper
            ->add('email', null, ['label' => 'メールアドレス'])
          ;

        $builder = $formMapper->getFormBuilder();

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();

            /** @var \App\Entity\Admin $admin */
            $admin = $form->getData();
            $this->adminManager->updatePassword($admin);
        });
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, [
                'label' => 'ID',
            ])
            ->add('username', null, [
                'label' => 'ログインID',
            ])
            ->add('enabled', null, [
                'label' => '有効',
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

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('username', null, [
                'label' => 'ログインID'
            ])
            ->add('enabled', null, [
                'label' => '有効',
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

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('username', null, [
                'label' => 'ログインID',
            ])
            ->add('emailCanonical', null, [
                'label' => 'メール',
            ])
            ->add('enabled', null, [
                'label' => '有効',
            ])
            ->add('salt')
            ->add('lastLogin', null, ['label' => '最終ログイン日時'])
            ->add('roles', null, [
                'label' => '権限',
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