<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\Type\IsPublishedType;
use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EditArticleForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('title', TextType::class)
      ->add('author', TextType::class)
      ->add('createdAt', DateType::class, [
        'widget' => 'text',
        'format' => 'dd-MM-yyyy'
      ])
      ->add('isPublished', new IsPublishedType())
      // ->add('isPublished', ChoiceType::class, [
      //   'choices' => [
      //     'Tak' => true,
      //     'Nie' => false
      //   ],
      //   'expanded' => true
      // ])
      ->add('body', TextareaType::class)
      ->add('save', SubmitType::class);
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
