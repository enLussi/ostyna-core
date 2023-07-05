<?php

namespace Ostyna\Component\Framework\Form;

use Ostyna\Component\Framework\Constraints\Length;
use Ostyna\Component\Interface\FormElementsInterface;

class InputRadio extends FormElement implements FormElementsInterface
{

  public function __construct(string $name, ?Label $label, string|int $value = "", array $attributes = [])
  {
    $this->setTag('input');

    array_push($this->allowed_attribtutes, 'type');
    $attributes['type'] = 'radio';
    $attributes['value'] = $value;
    $this->label = $label;

    parent::__construct($name, $value, $attributes);
  }

  // public function allow_constraints(array $contraints)
  // {
  //   $this->allowed_constraints = [
  //     Length::class
  //   ];
  // }

  // public function verify_type(string $type) {
  //   if(in_array($type, $this->allowed_types)) {
  //     return true;
  //   }
  //   return false;
  // }
}




