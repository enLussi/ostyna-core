<?php

use Ostyna\Component\Utils\ConsoleUtils;

ConsoleUtils::add_commands([
  'name' => 'controller',
  'option' => [
    'new',
  ],
  'method' => 'Ostyna\\Component\\Commands\\ControllerCommand::execute'
]);