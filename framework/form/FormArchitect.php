<?php

namespace Ostyna\Component\Framework\Form;

use Ostyna\Component\Interface\FormArchitectInterface;

// La classe du Formulaire qui rassemblera les données nécessaires pour générer le code html
class FormArchitect implements FormArchitectInterface
{

   private array $elements = [];

   public function __construct(private string $action = "", private string $method = 'POST')
   {
   }

   public function add(FormElement $element): static {
      if(!isset($this->elements[$element->getName()])) {
         $this->elements[$element->getName()] = $element;
      }
      return $this;
   }

   public function remove(string $name): static {
      if(!isset($elements[$name])) {
         unset($elements[$name]);
      }
      return $this;
   }

   public function get(string $name): FormElement {
      if(isset($elements[$name])) {
         return $elements[$name];
      }
      return null;
   }

   public function has(string $name): bool {
      if(isset($elements[$name])) {
         return true;
      }
      return false;
   }

   public function get_all(): array {
      return $this->elements;
   }

   public function build(): string {
      $content = "<form action=\"$this->action\" method=\"$this->method\">";
      foreach($this->elements as $element) {
         $content .= $element->build();
      }
      $content .= "</form>";
      return $content;
   }

   /**
    * Get the value of action
    */ 
   public function getAction()
   {
      return $this->action;
   }

   /**
    * Set the value of action
    *
    * @return  self
    */ 
   public function setAction($action)
   {
      $this->action = $action;

      return $this;
   }

   /**
    * Get the value of method
    */ 
   public function getMethod()
   {
      return $this->method;
   }
}