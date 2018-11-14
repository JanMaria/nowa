<?php

declare(strict_types=1);

namespace App\FormHandler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;

class FormHandler
{
  private $manager;

  public function __construct(EntityManager $manager)
  {
    $this->manager = $manager;
  }

  public function handleForm(Form $form)
  {

  }
}
