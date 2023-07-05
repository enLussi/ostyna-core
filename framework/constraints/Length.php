<?php

namespace Ostyna\Component\Framework\Constraints;

use Ostyna\Component\Interface\FormConstraintInterface;

class Length extends FormConstraint
{
  public $min;
  public $max;
  public $size;

  public function __construct(int $size = null, int $min = null, int $max = null)
  {
    $this->min = $min;
    $this->max = $max;
    $this->size = $size;

    parent::__construct();
  }
}