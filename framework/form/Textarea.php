<?php

namespace Ostyna\Component\Framework\Form;

use Ostyna\Component\Framework\Constraints\Length;
use Ostyna\Component\Interface\FormElementsInterface;

class Textarea extends FormElement implements FormElementsInterface
{

  private string $cols = "100";
  private string $rows = "3";

  public function __construct(string $name, ?Label $label, string|int $value = "", array $attributes = [], array $constraints = [] )
  {
    array_push($this->allowed_attribtutes, 'cols', 'rows');
    $this->setTag('textarea', false);

    parent::__construct($name, $value, $label, $constraints, $attributes);
    
    $this->cols = isset($attributes['cols']) ? $attributes['cols'] : "";
    $this->rows = isset($attributes['rows']) ? $attributes['rows'] : "";
  }

  public function allow_constraints(array $contraints)
  {
    $this->allowed_constraints = [
      Length::class
    ];
  }


}