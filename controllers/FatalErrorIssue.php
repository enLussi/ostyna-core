<?php

namespace Ostyna\Component\Controllers;

use Ostyna\Component\Error\FatalException;
use Ostyna\Component\Utils\CoreUtils;

class FatalErrorIssue extends ErrorIssue {

  public function display() {
    if(CoreUtils::get_error() !== false) {

      if(!isset(CoreUtils::get_config()['error_template'])) {
        $this->flat_render(CoreUtils::get_error()->getMessage());

        return $this->send_view();
      } 

      $this->render(CoreUtils::get_config()['error_template'] . '/fatal_error.html', [
        'error' => CoreUtils::get_error()->getMessage()
      ]);

    }
    $this->flat_render('Un problème est survenu');
  }
}