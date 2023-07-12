<?php

namespace Ostyna\Component\Framework\Form;

use Ostyna\Component\Interface\FormElementsInterface;

class Option extends FormElement implements FormElementsInterface
{

  public function __construct (array $attributes = [], string $content = "") {
    $this->setTag('option', false);
    $this->allowed_attribtutes = ['value', 'disabled', 'label'];

    
    // $value = isset($attributes['content']) ? $attributes['content'] : "";
    parent::__construct("", $content, $attributes);
  }

}