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

    $this->origin = explode('?', $_SERVER['REQUEST_URI'])[0]; 

  }

  private function __clone(){}

  public static function getInstance(): self {
    if(!isset(static::$instance)) {
      self::$instance = new BaseCore();
    }

    return self::$instance;
  }

  public function load(){

    (new Dotenv(CoreUtils::get_project_root() . '/.env'))->load();

    RoutesUtils::load_routes();

    try {
      if (RoutesUtils::route_exists($this->origin) !== false) {
        $key = array_search($this->origin, array_column(RoutesUtils::get_routes(), 'path'));

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