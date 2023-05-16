<?php

namespace Ostyna\Core;

use Exception;
use Ostyna\Component\Environment\Dotenv;
use Ostyna\Component\Utils\CoreUtils;
use Ostyna\Component\Utils\RoutesUtils;

class BaseCore {

  private static BaseCore $instance;

  private string $origin;

  private function __construct() {
    (new Dotenv(CoreUtils::get_project_root() . '/.env'))->load();
  }

  private function __clone(){}

  public static function getInstance(): self {
    if(!isset(static::$instance)) {
      self::$instance = new BaseCore();
    }

    return self::$instance;
  }

  public function console() {
    foreach(CoreUtils::get_config()['dev']['preload'] as $preload) {
      require_once CoreUtils::get_project_root() . '/vendor/' . $preload . '/preload.php';
    }
  }

  public function load(){

    
    $this->origin = explode('?', $_SERVER['REQUEST_URI'])[0]; 
    RoutesUtils::load_routes();

    try {
      if (RoutesUtils::route_exists($this->origin) !== false) {
        $key = null;
        foreach(RoutesUtils::get_routes() as $route_key => $route) {
          if($route['path'] === $this->origin) {
            $key = $route_key;
            break;
          }
        }

        if($key !== false) {
          CoreUtils::redirect($key);
        }
        throw new Exception('Routes does not exists for some reason.');
      } else {

        // $this->notfound_redirect();
    
      }
    } catch (Exception $exception) {
      CoreUtils::set_error($exception);
      CoreUtils::redirect('fatalerror');
    }

  }

 
}