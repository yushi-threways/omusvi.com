<?php

namespace App\Form;

use App\Entity\MyEvent;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


class MyEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'イベント画像 (jpeg, png)',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'image_uri' => true,
                'attr' => ['placeholder' => 'アップロード　jpeg, png ファイル']
            ])
            ->add('name', null, [
                'label' => 'イベント名',
                'attr' => ['placeholder' => 'イベント名']
            ])
            ->add('description', null, [
                'label' => 'イベント見出し',
                'attr' => ['placeholder' => 'イベント見出しを入力してください']
            ])
            ->add('start_date', null, [
                'label' => 'イベント開催日'
            ])
            ->add('start_time', null, [
                'label' => 'イベント開催時間'
            ])
            ->add('end_date', null, [
                'label' => 'イベント終了日'
            ])
            ->add('end_time', null, [
                'label' => 'イベント終了時間'
            ])
            ->add('content', null, [
                'label' => 'イベント内容',
                'attr' => ['placeholder' => 'イベント内容を入力してください']   
            ])
            ->add('men_price', null, [
                'label' => '男性料金',
                'attr' => ['placeholder' => '男性料金を入力してください']   
            ])
            ->add('woman_price', null, [
                'label' => '女性料金',
                'attr' => ['placeholder' => '女性料金を入力してください']   
            ])
            ->add('men_old', null, [
                'label' => '男性年齢',
                'attr' => ['placeholder' => '例)20~30']   
            ])
            ->add('woman_old', null, [
                'label' => '女性年齢',
                'attr' => ['placeholder' => '例)20~30']   
            ])
            ->add('men_remit', null, [
                'label' => '最大男性参加人数',
                'attr' => ['placeholder' => '男性年齢を入力してください']   
            ])
            ->add('woman_remit', null, [
                'label' => '最大女性参加人数',
                'attr' => ['placeholder' => '女性年齢を入力してください']   
            ])
            ->add('shop_name', null, [
                'label' => ' 会場名',
                'attr' => ['placeholder' => '会場店舗名を入力してください']   
            ])
            ->add('address', null , [
                'label' => '会場住所',
                'attr' => ['placeholder' => '会場住所を入力してください']   
            ])
            ->add('traffic', null, [
                'label' => '交通手段・アクセス',
                'attr' => ['placeholder' => '交通手段を入力してください']   
            ])
            ->add('contact', null, [
                'label' => '主催/お問い合わせ先',
                'attr' => ['placeholder' => 'お問い合わせ先を入力してください']   
            ])
            ->add('tel', null, [
                'label' => '電話番号',
                'attr' => ['placeholder' => '連絡先を入力してください']   
            ])
        ;
        // $builder
        // ->add('tags', EntityType::class, [
        //     'class' => Tag::class,
        //     'choice_label' => function ($tag) {
        //         return $tag->getName();
        //     }
        // ]);
    
        $builder
        ->add('flow', CollectionType::class, [
          'entry_type' => FlowType::class,
          'entry_options' => [
            'attr' => ['class' => 'flow'],
          ],
          'label' => 'イベントの流れ',
          'entry_options' => ['label' => false],
          'allow_add' => true,
          'allow_delete' => true,
          'by_reference' => false,
        ])
      ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyEvent::class,
        ]);
    }
}
