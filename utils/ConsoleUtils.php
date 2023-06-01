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
      if(!in_array($option, self::get_command($name)['option'] )) 
        return false;
    }
    return true;
  }

  public static function option_exists(string $name, string $option): bool {
    if(!in_array($option, self::$commands[self::get_command($name)] )) 
      return false;
    return true;
  }

  // * la fonction de callback doit vérifier si la valeur donner par l'utilisateur est conforme
  // pour le traitement à faire en aval est doit renvoyé un boolean.
  // * prompt est la question posé en elle même. Essayer de la faire suffisament clair et concise
  // * comment est un ajout d'information qui ne s'affichera pas de la même manière que le prompt
  // pour un souci de lisibilité.
  // * help est un message d'aide activé par ? 
  public static function prompt_response(
    string $prompt, 
    $callback, 
    string $comment = "", 
    string $help="", 
    string $error_message = "", 
    ?string $default = null,
    $data = []
    ): string {

    $processing = true;

    $response = $default;

    echo "\n\e[92m". $prompt ." \e[93m[".$default."]\e[92m:\e[39m" . PHP_EOL;
    echo "\e[36m". $comment ."\e[39m" . PHP_EOL;

    do {
      $response = readline('> ');
      if($response === "?") {
        echo "\e[93m" . $help . "\e[39m" . PHP_EOL;
      } else if(!$callback($response, $data) && !is_null($response)){
        echo "\e[91m". $error_message . "\e[39m" . PHP_EOL;
        continue;
      } else {
        $processing = false;
      }
    }while($processing);

    return $response;

  }

  public static function success_prompt(string $message) {

    $blank = "";
    for($space = 0; $space <= strlen($message)+3; $space ++) {
      $blank .= " ";
    }
    
    $line = "\n \e[42m\e[32m$blank\e[39m\e[49m";
    $text = "\n \e[42m  \e[97m$message\e[39m  \e[49m";

    echo $line . $line . $text . $line . $line ."\n". PHP_EOL;
  }

  public static function abort_prompt(string $message) {

    $blank = "";
    for($space = 0; $space <= strlen($message)+3; $space ++) {
      $blank .= " ";
    }
    
    $line = "\n \e[101m\e[32m$blank\e[39m\e[49m";
    $text = "\n \e[101m  \e[97m$message\e[39m  \e[49m";

    echo $line . $line . $text . $line . $line ."\n". PHP_EOL;
  }

  public static function prompt_message(string $message, string $type) {
    $text = "";
    switch($type) {
      case 'error':
        $text .= "\n\e[91m";
        break;
      case 'info':
        $text .= "\n\e[94m";
        break;
      case 'success':
        $text .= "\n\e[92m";
        break;
      default:
        $text .= "\n\e[37m";
        break;
    }

    $text .= " $message\e[39m";

    echo $text . "\n";
  }

  public static function write_in_file(string $path, string $success_message, string $content, string $options = 'a') {
    if($open = fopen(CoreUtils::get_project_root().$path, $options)) {
      if(fwrite($open, $content) === false) {
        ConsoleUtils::prompt_message("Impossible d'écrire dans le fichier", 'danger');
        ConsoleUtils::abort_prompt("Aborted");
        exit;
      }
      ConsoleUtils::prompt_message($success_message, 'info');
      fclose($open);
    } else {
      ConsoleUtils::prompt_message("Impossible d'ouvrir dans le fichier", 'danger');
      ConsoleUtils::abort_prompt("Aborted");
      exit;
    }
  }

  public static function json_in_file(string $path, string $success_message, array $content, bool $erase = false, string $value = "") {

    if(!file_exists(CoreUtils::get_project_root().$path)) {
      $open = [];
      $open[] = $content;
      file_put_contents(CoreUtils::get_project_root().$path, json_encode($open, JSON_PRETTY_PRINT));
    } else {
      $open = json_decode(file_get_contents(CoreUtils::get_project_root().$path), true);

      if($erase) {
        $open = $content;
      } else {
        if(strlen($value) > 0) {
          $open[$value] = $content;
        } else {
          $open[] = $content;
        }
      }
      file_put_contents(CoreUtils::get_project_root().$path, json_encode($open, JSON_PRETTY_PRINT));
    }
    ConsoleUtils::prompt_message($success_message, 'info');
  }
}