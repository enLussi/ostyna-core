<?php

namespace Ostyna\Component\Error;

class FatalException extends \Exception {

  public function __construct(string $message, int $code) {

    parent::__construct($message, $code);

  }

}