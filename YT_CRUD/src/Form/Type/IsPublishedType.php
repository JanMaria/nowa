<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IsPublishedType
{
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'choices' => [
        'tak' => 'tak',
        'nie' => 'nie'
      ],
      'choices_as_values' => true
    ]);
  }

  public function getParent()
  {
    return 'choice';
  }

  public function getName()
  {
    return 'isPublishedOpts';
  }
}
