<?php

namespace Ostyna\Component\Framework\Constraints;

use Ostyna\Component\Interface\FormProcessConstraintInterface;

class NotBlank extends FormConstraint
{
  public $message = "This message should not blank";

  public function __construct()
  {
    

    parent::__construct();
  }

}