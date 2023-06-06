<?php

namespace Ostyna\Component\Commands;

use Ostyna\Component\Utils\ConsoleUtils;

class ControllerCommand extends AbstractCommand
{
  public function execute(array $options = []) {
    $executing = true;
    while (count($options) > 0 && $executing) {
      switch($options[0]) {
        case 'new':
          $options = $this->delete_same_category_options($options, ['modify', 'prepare', 'remove']);
          $executing = $this->new_controller();
          $options = array_diff($options, ['new']);
          break;
        default:
          break;
      }
    }

    if($executing) {
      ConsoleUtils::success_prompt("Success");
    } else {
      ConsoleUtils::abort_prompt("Aborted");
    }
  }

  private function new_controller(): bool {
    return true;
  }
}