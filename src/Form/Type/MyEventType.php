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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\MyEventVenue;

class MyEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('content')
            ->add('menPrice')
            ->add('womanPrice')
            ->add('imageFile', VichImageType::class, [
              'required' => true,
              'allow_delete' => true,
              'download_uri' => true,
              'image_uri' => true,
              // 'asset_helper' => true,
            ])
            ->add('tags', TagsInputType::class, [
              'label' => 'label.tags',
              'required' => false,
            ])
            ->add('myEventSchedule', MyEventScheduleType::class)
            ->add('myEventVenue', EntityType::class, [
                'class' => MyEventVenue::class,
                'choice_label' => 'name',
            ])
            ->add('myEventFlows', CollectionType::class, [
              'entry_type' => MyEventFlowType::class,
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
