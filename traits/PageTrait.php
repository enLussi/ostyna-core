<?php

namespace Ostyna\Component\Traits;

use Ostyna\Component\Error\FatalException;
use Ostyna\Component\Utils\CoreUtils;
use Ostyna\Sing\Utils\TemplateUtils;

trait PageTrait {

  protected string $title = '';
  protected array $styles = [];
  protected array $scripts = [];

  protected string $content = '';

  // Fonction a appeler dans display pour remplir la variable content.
  // La variable content contiendra le fichier html complet et sera envoyé à la vue.
  protected function render(string $pathView, $parameters = []){
    if (!file_exists(CoreUtils::get_project_root() .'/'. CoreUtils::get_config('templates') . $pathView)) {
      throw new FatalException('Template does not exists', 1);
    }

    // Third event : Avant la récupération du contenu de template
    // core.template avec les infos $pathView et $parameters

    // $this->content = file_get_contents(CoreUtils::get_project_root() . '/templates/' . $pathView);
    // compiler le contenu de la page avec le moteur de template sing
    if(class_exists('Ostyna\Sing\Utils\TemplateUtils')) {
      $this->content = TemplateUtils::sing(CoreUtils::get_project_root() . '/templates/' . $pathView, $parameters);
    } else {
      $this->content = "html";
    }


    $this->send_view();
  }

  protected function flat_render(string $content){
    $this->content = $content;
  }

  protected function send_view() {

    // Fourth event : Avant l'envoi de la vue
    // core.view avec les infos $content

    echo $this->content;

  }

  public function get_content() {
    return $this->content;
  }
}