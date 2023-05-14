<?php

namespace Ostyna\Component\Utils;

class CoreUtils {

  private string $projectRoot;

  // $_ENV $_POST $_GET

  public static function getProjectRoot () {
    if (!isset(self::$projectRoot)) {
      $dir = dirname(__DIR__);

      while (!is_file($dir.'/composer.json')) {
        $dir = dirname($dir);
      }
      self::$projectRoot = $dir;
    }
    return self::$projectRoot;
  }

}