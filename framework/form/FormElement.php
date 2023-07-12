<?php

namespace Ostyna\Component\Framework\Form;

// classe mère des types d'éléments composants un formulaire (champs)
// Toutes les valeurs nécessaires pour un champs du formulaire (name, type, placeholder, min, max, etc...)
abstract class FormElement
{
  // private string $name;
  // private string|int $value;
  protected string $placeholder = "";
  protected bool $required = true;
  protected bool $disabled = false;
  protected bool $readonly = false;
  protected string $maxLength;
  protected string $min;
  protected string $minlength;
  protected string $max;
  protected string $maxlength;
  protected string $step;
  protected bool $multiple;
  protected bool $checked;
  protected string $HTMLclass = "";
  protected string $HTMLid = "";
  protected ?Label $label;

  protected string $message = "Not Valid";

  // protected array $allowed_constraints = [];
  protected array $allowed_attribtutes = [
    'name', 'class', 'id', 'placeholder', 'value', 'disabled', 'hidden', 'required'
  ];
  protected string $tag;
  protected bool $autoclose;

  public function __construct(protected string $name, protected string|int $value, protected array $attributes = [])
  {
    $attributes['name'] = $name;
    $attributes['id'] = $name;
    if(!isset( $attributes['required'])) {
      $attributes['required'] = "true";
    }
    if($attributes['required'] === "false") {
      unset($attributes['required']);
    }
    

    $this->attributes = $this->verify_attributes($attributes);

    if(isset($name) && strlen($name) > 0 && isset($this->label)) {
      $this->label->setFor($this->name);
    }
    $this->HTMLid = isset($attributes['id']) ? $attributes['id'] : "";
    $this->HTMLclass = isset($attributes['class']) ? $attributes['class'] : "";
  }

  // protected function verify_constraints(array $constraints)
  // {
  //   foreach($constraints as $constraint) {
  //     $verified = false;

  //     foreach($this->allowed_constraints as $allowed) {
  //       if($constraint instanceof $allowed) {
  //         $verified = true;
  //       }
  //     }

  //     if($verified === false) {
  //       return false;
  //     }
  //   }
  // }

  protected function verify_attributes(array $attributes ): array {
    foreach($attributes as $key => $attribute) {
      if(!in_array($key, $this->allowed_attribtutes)) {
        unset($attributes[$key]);
      }
    }
    return $attributes;
  }

  public function build(): string {
    $content = "<$this->tag ";
    if(isset($this->label)) {
      $content = ($this->label->isPreceding() ? $this->build_label() : "") ."<$this->tag ";
    }

    foreach( $this->attributes as $attr => $value) {
      $content .= $this->build_attributes($attr, $value);
    }

    // $content .= $this->build_constraints();

    $content .= ">";
    if($this->autoclose === false) {
      $content .= "$this->value</$this->tag>";
    }
    if(isset($this->label) && $this->label->isPreceding() === false) {
      $content .= $this->build_label();
    }
    return $content;
  }

  protected function build_label(): string {
    $content = "";
    if(!is_null($this->label)) {
      $content = $this->label->build($this->name);
    }
    return $content;
  }

  protected function build_attributes(string $attr, mixed $value): string {
    if(is_array($value)) {
      $this->message = isset($value['message']) ? $value['message'] : $this->message;
      return "$attr=\"$value[value]\"";
    }
    elseif(is_string($value) && strlen($value > 0)) {
      return "$attr=\"$value\" ";
    }
    return "";
  }

  // protected function build_constraints(): string
  // {
  //   $content = "";
  //   foreach($this->constraints as $constraint) {
      
  //     $content = $constraint->build()." ";
  //   }
  //   return $content;
  // }

  protected function setTag(string $tag, bool $autoclose = true) {
    $this->tag = $tag;
    $this->autoclose = $autoclose;
  }


  /**
   * Get the value of name
   */ 
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of value
   */ 
  public function getValue()
  {
    return $this->value;
  }

  /**
   * Set the value of value
   *
   * @return  self
   */ 
  public function setValue($value)
  {
    $this->value = $value;

    return $this;
  }
}