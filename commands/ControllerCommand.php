<?php

namespace Ostyna\Component\Commands;

use Ostyna\Component\Utils\ConsoleUtils;
use Ostyna\Component\Utils\CoreUtils;

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
    $class = ConsoleUtils::prompt_response("Nom du controller", function (string $response) {
      if(strlen($response) <= 3) {
        return false;
      } 
      return true;
    }, "", "", "Nom de classe non valide (nom trop court[3] ou déjà existant)", "");

    $class = strtolower($class);
    $class_name = ucfirst($class)."Controller";

    $file = $this->generate_by_skeleton('controller.skl.php', ['class' => $class_name]);
    $template = $this->generate_by_skeleton('template.skl.php');

    ConsoleUtils::write_in_file("/src/controllers/$class_name.php", "Created Reference: $class_name;php", $file, 'w+');
    ConsoleUtils::write_in_file("/templates/web/index_$class.html", "Created Reference: $class.html", $template, 'w+');

    return true;
  }
}