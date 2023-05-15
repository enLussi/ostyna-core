<?php

namespace Ostyna\Component\Utils;

use Ostyna\Component\Error\FatalException;

class ConsoleUtils {

  private static array $commands = [];

  const KEY_LIST = [
    "name",
    "option",
    "method"
  ];

  public static function add_commands(array $command): void {
    foreach($command as $key => $params) {
      if(!in_array($key, self::KEY_LIST, true)){
        throw new FatalException('Wrong command configuration', 0);
      }
    }

    self::$commands = [
      ...self::$commands,
      $command
    ];
  }

  public static function interprete(string $name, array $option) {
    $key = array_search($name, array_column(self::$commands, 'name'));

    [$class, $method] = explode('::', self::$commands[$key]['method']);

    (new $class())->$method(option: $option);
  }
}