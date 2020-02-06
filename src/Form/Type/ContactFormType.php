<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Valid;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'constraints' => array(
                    new NotBlank(array(
                        'message' => '名前を入力してください'
                    )),
                    new Length(array(
                        'max' => 100,
                        'maxMessage' => '{{ limit }}文字以内で入力してください',
                        'min' => 2,
                        'minMessage' => '{{ limit }}文字以上で入力してください',
                    )),
                ),
            ))
            ->add('email', RepeatedType::class, array(
                'type' => EmailType::class,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'メールアドレスを入力してください'
                    )),
                    new Length(array(
                        'max' => 100,
                        'maxMessage' => '{{ limit }}文字以内で入力してください',
                        'min' => 2,
                        'minMessage' => '{{ limit }}文字以上で入力してください',
                    )),
                ),
                'first_options' => array(
                    'label' => 'form.contact.email',
                ),
                'second_options' => array(
                    'label' => 'form.contact.emailconfirmation',
                ),
                'invalid_message' => 'メールアドレスが一致しません',
            ))
            ->add('telNumber', null, array(
                'label' => 'form.registration.telNumber',
                'constraints' => array(
                    new NotBlank(array(
                        'message' => '電話番号を入力してください'
                    )),
                    new Regex(array(
                        'pattern' => '/^[0-9]{8,15}$/',
                        'message' => "正しい電話番号を入力してください",
                    )),
                ),
            ))
            ->add('body', TextareaType::class, array(
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'お問い合わせ内容を入力してください'
                    )),
                    new Length(array(
                        'max' => 2000,
                        'maxMessage' => '{{ limit }}文字以内で入力してください',
                        'min' => 5,
                        'minMessage' => '{{ limit }}文字以上で入力してください',
                    )),
                ),
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_token_id' => 'contact',
            // BC for SF < 2.8
            'intention'  => 'contact',
        ));
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
