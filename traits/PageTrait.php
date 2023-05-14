<?php

namespace Ostyna\Component\Traits;

use Ostyna\Component\Error\FatalException;
use Ostyna\Component\Utils\CoreUtils;

trait PageTrait {

  protected string $title = '';
  protected array $styles = [];
  protected array $scripts = [];

  protected string $content = '';

  // Fonction a appeler dans display pour remplir la variable content.
  // La variable content contiendra le fichier html complet et sera envoyé à la vue.
  protected function render(string $pathView, $parameters = []){
    if (!file_exists(CoreUtils::getProjectRoot() . '/templates/' . $pathView)) {
      throw new FatalException('Template does not exists', 1);
    }

    $this->content = file_get_contents(CoreUtils::getProjectRoot() . '/templates/' . $pathView);
  }

  protected function flat_render(string $content){
    $this->content = $content;
  }

  public function get_content() {
    return $this->content;
  }
}