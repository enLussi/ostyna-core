<?php

namespace Ostyna\Core;

use Exception;
use Ostyna\Component\Utils\CoreUtils;

class autoload {

  static function register() {
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  static function autoload ($class_name) {

    $class_name = explode('\\', $class_name);
    $class_name = array_pop($class_name);

    $dirs = self::list_directories(CoreUtils::get_project_root().'/src');

    foreach ( $dirs as $dir) {
      self::require_file($dir, $class_name);
    }
    
  }

  static function require_file (string $path, string $class_name) {

    if (!is_dir($path)) {
      throw new Exception($path.' is not a directory', 3001);
    }

    if(file_exists($path.'/'.$class_name.'.php')) {
      require_once $path.'/'.$class_name.'.php';
    }

  }

  static function list_directories(string $directory) {
    $directories = [];

    if(is_dir($directory)) {
      $directories[] = $directory;

      $subdirectories = glob($directory . '/*', GLOB_ONLYDIR);

      foreach($subdirectories as $subdirectory) {
        $directories = array_merge($directories, self::list_directories($subdirectory));
      }
    }

    return $directories;
  }

}

?>