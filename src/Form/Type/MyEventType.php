<?php

namespace App\Form\Type;

use App\Entity\MyEvent;
use App\Form\Type\TagsInputType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\MyEventVenue;
use App\Entity\MyEventSchedule;
use Symfony\Component\Form\FormInterface;

class MyEventType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
              'label' => 'イベント名',
          ])
            ->add('description', null, [
              'label' => 'イベント詳細',
          ])
            ->add('content', null, [
              'label' => 'イベント内容',
          ])
            ->add('menPrice', null, [
              'label' => '男性料金',
          ])
            ->add('womanPrice', null, [
              'label' => '女性料金',
          ])
            ->add('imageFile', FileType::class, [
              'required' => true,
              'label' => 'イベント画像'
              // 'asset_helper' => true,
            ])
            ->add('tags', TagsInputType::class, [
              'label' => '関連するタグ',
              'required' => false,
            ])
            ->add('myEventSchedule', MyEventScheduleType::class, [
              'label' => 'イベントスケジュール'
            ])
            ->add('myEventVenue', EntityType::class, [
                'class' => MyEventVenue::class,
                'choice_label' => 'name',
                'label' => 'イベント開催場所'
            ])
            ->add('myEventFlows', CollectionType::class, [
              'entry_type' => MyEventFlowType::class,
              'label' => 'イベントの流れ',
              'entry_options' => [
                'attr' => ['class' => 'flows'],
              ],
              'entry_options' => ['label' => false],
              'allow_add' => true,
              'allow_delete' => true,
              'by_reference' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MyEvent::class,
        ]);
    }
}
