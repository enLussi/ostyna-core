<?php

namespace Ostyna\Core;

use Ostyna\Component\Error\FatalException;

class BaseCore {

  private static BaseCore $instance;

  private array $routes;

  private string $projectRoot;

  private string $origin;

  private function __construct() {

    $this->origin = explode('?', $_SERVER['REQUEST_URI'])[0]; 
    $this->projectRoot = $this->getProjectRoot();

  }

  private function __clone(){}

  public static function getInstance(): self {
    if(!isset(static::$instance)) {
      self::$instance = new BaseCore();
    }

    return self::$instance;
  }

  public function load(){

    if(!file_exists($this->projectRoot . '/config/routes.json')) {
      throw new FatalException('Missing routes files in : /config', 404);
    }
    $this->routes = json_decode(file_get_contents($this->projectRoot . '/config/routes.json'), true);

    // Chargé la liste des évènements ici

    if ($this->route_exists() !== false) {
  
      // $this->redirect($origine);
  
    } else {

      // $this->notfound_redirect();
  
    }

  }

  public function route_exists () {

    foreach($this->routes as $key => $route) {
      if ( $route['path'] === $this->origin) return $key;
    }
  
    return false;
  
  }

  public function getProjectRoot () {
    if (!isset($this->projectRoot)) {
      $dir = dirname(__DIR__);

      while (!is_file($dir.'/composer.json')) {
        $dir = dirname($dir);
      }
      $this->projectRoot = $dir;
    }
    return $this->projectRoot;
  }
}