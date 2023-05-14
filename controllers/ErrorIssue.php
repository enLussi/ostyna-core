<?php

namespace Ostyna\Component\Controllers;

use Ostyna\Component\Framework\AbstractPageControlller;

abstract class ErrorIssue extends AbstractPageControlller {

  public function display() {

    $this->flat_render('message');
  }

}