<?php

namespace Ostyna\Component\Utils;

use Exception;
use Ostyna\Component\Error\FatalException;

class CoreUtils {

  private static string $projectRoot;
  private static array $config;
  private static Exception $exception;

  public static function get_config() {
    if(!isset(self::$config)) {
      if(!file_exists(self::get_project_root() . '/config/config.json')) {
        throw new Exception('File config/config.json missing.');
      }
      self::$config = json_decode(file_get_contents(self::get_project_root() . '/config/config.json'), true);
    }
    return self::$config;
  }

  public static function get_project_root () {
    if (!isset(self::$projectRoot)) {
      $dir = dirname(__DIR__);

      while (!is_file($dir.'/composer.lock')) {
        $dir = dirname($dir);
      }
      self::$projectRoot = $dir;
    }
    return self::$projectRoot;
  }

  public static function redirect(?string $key) {

    $route = RoutesUtils::route_exists(key_route: $key);

    if($route === false) {
      throw new FatalException('Route not valid', 404);
    }

    [$class, $method] = explode('::', $route['method']);
    (new $class())->$method();
  }

  public static function set_error(Exception $exception) {
    self::$exception = $exception;
  }

  public static function get_error() {
    if(!isset(self::$exception)){
      return false;
    }
    return self::$exception;
  }

  public static function get_env() {
    return $_ENV;
  }

  public static function get_request() {
    return $_POST;
  }

  public static function get_params() {
    return $_GET;
  }

  // Pour générer un uniqid 
  public static function uniqidReal(int $length = 13) {
    if (function_exists("random_bytes")) {
      $bytes = random_bytes(ceil($length / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $length);
  }

}