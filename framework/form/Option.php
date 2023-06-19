<?php

namespace Ostyna\Component\Framework\Form;

use Ostyna\Component\Interface\FormElementsInterface;

class Option extends FormElement implements FormElementsInterface
{

  public function __construct (array $attributes = []) {
    $this->setTag('option', false);
    $this->allowed_attribtutes = ['value', 'disabled', 'label'];
    $value = isset($attributes['value']) ? $attributes['value'] : "";
    parent::__construct("", $value, null, [], $attributes);
  }


  public function allow_constraints(array $contraints)
  {
    $this->allowed_constraints = [
    ];
  }
}