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

  public static function interprete(string $name, array $options) {
    $key = self::command_exists($name);

    if($key === false) {
      echo 'Commande invalide.';
      return;
    } 
      
    if(self::options_exists($name, $options) === false){
      echo 'Option invalide.';
      return;
    }

    [$class, $method] = explode('::', self::$commands[$key]['method']);

    (new $class())->$method(options: $options);
  }

  public static function get_commands(): array {
    return self::$commands;
  }

  public static function get_command(string $name): ?array {
    $key = array_search($name, array_column(self::$commands, 'name'));
    return self::$commands[$key];
  }

  public static function command_exists(string $name) {
    $key = array_search($name, array_column(self::$commands, 'name'));
    return $key;
  }

  public static function options_exists(string $name, array $options): bool {
    foreach($options as $option) {
      if(!in_array($option, self::$commands[self::get_command($name)] )) 
        return false;
    }
    return true;
  }

  public static function option_exists(string $name, string $option): bool {
    if(!in_array($option, self::$commands[self::get_command($name)] )) 
      return false;
    return true;
  }
}