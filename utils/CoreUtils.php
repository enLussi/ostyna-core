<?php

namespace Ostyna\Component\Utils;

use Exception;
use Ostyna\Component\Error\FatalException;

class CoreUtils {

  private static string $projectRoot;
  private static Exception $exception;

  public static function getProjectRoot () {
    if (!isset(self::$projectRoot)) {
      $dir = dirname(__DIR__);

      while (!is_file($dir.'/composer.lock')) {
        $dir = dirname($dir);
      }
      self::$projectRoot = $dir;
    }
    return self::$projectRoot;
  }

  public static function redirect(string $key) {

    $route = RoutesUtils::route_exists(key_route: $key);

    if($route === false) {
      throw new FatalException('Route not valid', 404);
    }

    $class = explode('::', $route['method'])[0];
    $method = explode('::', $route['method'])[1];
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

}