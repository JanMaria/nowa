<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extention\Core\Type\DateTimeType;
use Symfony\Component\Form\Extention\Core\Type\CheckboxType;
use Symfony\Component\Form\Extention\Core\Type\TextareaType;

class ArticleForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, [] $options)
  {
    $builder
      ->add('title')
      ->add('author')
      ->add('createdAt', DateTimeType::class)
      ->add('isPublished', CheckboxType:class)
      ->add('body', TextareaType::class)
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Article:class,
    ])
  }
}
