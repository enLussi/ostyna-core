<?php

namespace Ostyna\Component\Controllers;

use Ostyna\Component\Utils\CoreUtils;

class FatalErrorIssue extends ErrorIssue {

  public function display() {
    if(CoreUtils::get_error() !== false) {
      $this->flat_render(CoreUtils::get_error()->getMessage());
    }
    $this->flat_render('Un problème est survenu');
  }
}