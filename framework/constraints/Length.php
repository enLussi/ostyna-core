<?php

namespace Ostyna\Component\Framework\Constraints;

use Ostyna\Component\Interface\FormConstraintInterface;

class Length extends FormConstraint implements FormConstraintInterface
{
  public function __construct(int $value)
  {
    parent::__construct($value);
  }

  public function build(): string {
    return "size=\"$this->value\"";
  }
}