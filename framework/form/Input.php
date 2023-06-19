<?php

namespace Ostyna\Component\Framework\Form;

use Ostyna\Component\Framework\Constraints\Length;
use Ostyna\Component\Interface\FormElementsInterface;

class Input extends FormElement implements FormElementsInterface
{

  private array $allowed_types = [
    'text', 'number', 'radio', 'checkbox', 'submit', 'range', 'submit', 'reset',
  ];

  public function __construct(string $name, ?Label $label, string|int $value = "", private string $type = "text", array $attributes = [], array $constraints = [])
  {

    $this->setTag('input');

    $this->allowed_attribtutes[] = 'type';
    $attributes['type'] = $type;
    $attributes['value'] = $value;

    //vérifier les contraintes

    parent::__construct($name, $value, $label, $constraints, $attributes);
  }

  public function allow_constraints(array $contraints)
  {
    $this->allowed_constraints = [
      Length::class
    ];
  }

  public function verify_type(string $type) {
    if(in_array($type, $this->allowed_types)) {
      return true;
    }
    return false;
  }
}




