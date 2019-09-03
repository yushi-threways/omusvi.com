<?php

namespace App\Form\Type;

use App\Entity\MyEvent;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        ;

        $builder
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyEvent::class,
        ]);
    }
}
