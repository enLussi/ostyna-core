<?php

namespace Ostyna\Core;

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

    // Chargé le fichier .env
    (new Dotenv(CoreUtils::getProjectRoot() . '/.env'))->load();

    RoutesUtils::load_routes();

    // Chargé la liste des évènements ici

    if (RoutesUtils::route_exists($this->origin) !== false) {
      echo "caca";
      // $this->redirect($origine);
  
    } else {

      // $this->notfound_redirect();
  
    }

  }

 
}