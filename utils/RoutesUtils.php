<?php

namespace Ostyna\Component\Utils;

use Ostyna\Component\Error\FatalException;

// Classe regroupant les fonctions utiles concernant les routes
// load_routes => charge les routes depuis routes.json
// route_exists => vérifie si une route existe selon l'url
// get_routes => renvoie le tableau de routes entier
// get_route => renvoie une entrée de tableau du tableau de routes
class RoutesUtils {

  private static array $routes;


  // Charge les routes prédéfini dans les fichier config/routes.json
  // Si le fichier n'existe pas, une erreur est lancé. 
  // Si le retour du fichier est null, une erreur est lancé.
  // Enfin la fonction renvoie si tout s'est bien passé un tableau de routes
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

  // Vérifie si une route existe selon le chemin de l'url du navigateur
  // Prends en paramètre le chemin url à tester.
  // Renvoie la clé du tableau de route correspondant à l'url ou false si la route n'existe pas.
  public static function route_exists(string $origin = '', string $key_route = '') {
    foreach(self::$routes as $key => $route) {
      if ( $origin !== '' && $route['path'] === $origin) return [$key, $route];
    }
    if(array_key_exists($key_route, self::$routes)) return [$key_route, self::$routes[$key_route]];
  
    return false;
  }

  // Renvoie le tableau de routes entier
  // Renvoie false si le tableau n'est pas initialisé
  public static function get_routes(): array {
    if (!isset(self::$routes)) return false;
    return self::$routes;
  }

  // Renvoie une entrée de tableau des routes selon un paramètre 
  // Le paramètre key correspond à la clé de l'entrée du tableau recherchée
  // Renvoie false si l'entrée n'existe pas.
  public static function get_route(string $key) {
    if(!isset(self::$routes[$key])) return false;
    return self::$routes[$key];
  }

}