<?php

namespace Ostyna\Component\Framework\Constraints;

// classe mères des contraintes de champs de formulaire
class FormConstraint 
{

  public function __construct(protected string|int $value)
  {
    
  }

  /**
   * Get the value of value
   */ 
  public function getValue()
  {
    return $this->value;
  }
}