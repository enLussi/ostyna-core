<?php

namespace Ostyna\Component\Controllers;

use Ostyna\Component\Utils\CoreUtils;

class FatalErrorIssue extends ErrorIssue {

  public function display() {
    $error = CoreUtils::get_error();

    if($error !== false) {

      if(!isset(CoreUtils::get_config()['error_template'])) {
        $this->flat_render($error->getMessage());
      } 

      return $this->render(CoreUtils::get_config('error_template').'/fatal_error.html', [
        'error' => $error,
      ]);

    } else {
      return $this->flat_render('Un problème est survenu');
    }
  }
}