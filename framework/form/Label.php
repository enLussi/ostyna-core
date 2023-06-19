<?php

namespace Ostyna\Component\Framework\Form;

class Label
{
  private string $for;

  public function __construct(private string $HTMLclass = "", private string $HTMLid = "", private string $title = "", private string $content = "", private bool $precede = true)
  {    
  }

  public function build(string $inputName) {
    $content = "";
    $label = $this->getContent();

    $label_attributes = [
      'class' => $this->HTMLclass, 
      'id' => $this->HTMLid,
    ];
    $content .= "<label for=\"$inputName\"";
    foreach( $label_attributes as $attr => $value) {
      $content .= $this->build_attributes($attr, $value);
    }

    $content .= ">$label</label>";
    return $content;
  }

  protected function build_attributes(string $attr, mixed $value): string {
    if(strlen($value > 0)) {
      return "$attr=\"$value\" ";
    }
    return "";
  }

  /**
   * Get the value of for
   */ 
  public function getFor()
  {
    return $this->for;
  }

  /**
   * Set the value of for
   *
   * @return  self
   */ 
  public function setFor(string $for)
  {
    $this->for = $for;

    return $this;
  }

  /**
   * Get the value of HTMLclass
   */ 
  public function getHTMLclass()
  {
    return $this->HTMLclass;
  }

  /**
   * Set the value of HTMLclass
   *
   * @return  self
   */ 
  public function setHTMLclass($HTMLclass)
  {
    $this->HTMLclass = $HTMLclass;

    return $this;
  }

  /**
   * Get the value of HTMLid
   */ 
  public function getHTMLid()
  {
    return $this->HTMLid;
  }

  /**
   * Set the value of HTMLid
   *
   * @return  self
   */ 
  public function setHTMLid($HTMLid)
  {
    $this->HTMLid = $HTMLid;

    return $this;
  }

  /**
   * Get the value of title
   */ 
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set the value of title
   *
   * @return  self
   */ 
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get the value of content
   */ 
  public function getContent()
  {
    return $this->content;
  }

  public function isPreceding()
  {
    return $this->precede;
  }
}