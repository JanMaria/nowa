<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Date;

class EditArticleForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('id', IntegerType::class, ['disabled' => true])
      ->add('title', TextType::class, [
        'constraints' => [
          new NotBlank(),
          new Regex([
            'pattern' => '#[A-Z]{1}\w+#',
            'message' => 'Tytuł piszemy z dużej litery'
          ]),
        ]
      ])
      ->add('author', TextType::class, [
        'constraints' => [
          new Regex([
            'pattern' => '#[A-Z]{1}[a-z]+\s[A-Z]{1}[a-z]+#',
            'message' => 'Pełne imię i pełne nazwisko z dużych liter'
          ]),

        ]
      ])
      ->add('createdAt', DateType::class, [
        'widget' => 'text',
        'format' => 'dd-MM-yyyy',
        'constraints' => [
          new Date([
            'message' => 'zły format'
          ]),
        ],
      ])
      ->add('isPublished', ChoiceType::class, ['choices' => $options['isPublishedOptions']])
      ->add('body', TextareaType::class, [
        'constraints' => [
          new Length([
            'min' => 100,
            'max' => 200,
            'minMessage' => 'za mało znaków',
            'maxMessage' => 'za dużo znaków',
          ]),

        ]
      ])
      ->add('save', SubmitType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'isPublishedOptions' => null,
    ]);
  }

/**
 * Nie wiem co robi kod poniżej. Przepisałem go z manuala symfony ale jak go
 * wykomentuję to wszystko wydaje się działać tak samo. Btw - czy mogę zadawać
 * ci pytania w takiej formie, czy raczej spisywać na kartce albo wysyłać mailem?
 */
  // public function configureOptions(OptionsResolver $resolver)
  // {
  //   $resolver->setDefaults([
  //     'data_class' => Article::class,
  //   ]);
  // }
}
