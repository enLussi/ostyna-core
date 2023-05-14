<?php

namespace Ostyna\Component\Utils;

use Ostyna\Component\Error\FatalException;

class RoutesUtils {

  private array $routes;

  public static function load_routes(): ?array {
    if(!file_exists(CoreUtils::getProjectRoot() . '/config/routes.json')) {
      throw new FatalException('Missing routes files in : /config', 404);
    }
    
    if (!isset(self::$routes)) {
      self::$routes = json_decode(file_get_contents(CoreUtils::getProjectRoot() . '/config/routes.json'), true);
    }
    if (is_null(self::$routes)) {
      throw new FatalException('"routes" array is null.', 1);
    }
    
    return self::$routes;
  }

  public static function route_exists(string $origin) {
    foreach(self::$routes as $key => $route) {
      if ( $route['path'] === $origin) return $key;
    }
  
    return false;
  }

}