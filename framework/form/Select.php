<?php 

namespace Ostyna\Component\Framework\Form;

use Ostyna\Component\Interface\FormElementsInterface;

class Select extends FormElement implements FormElementsInterface
{

  public function __construct (string $name, ?Label $label, array $attributes = [], array $constraints = [], private array $options = []) {
    $this->setTag('select', false);

    $value = $this->build_options();
    $this->label = $label;
    parent::__construct($name, $value, $attributes);
  }

  private function build_options(): string {
    $content = "";

    foreach($this->options as $option) {
      if($option instanceof Option) {
        $content .= $option->build();
      }
    }

    return $content;
  }
}