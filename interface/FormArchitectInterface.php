<?php

namespace Ostyna\Component\Interface;

use Ostyna\Component\Framework\Form\FormElement;

interface FormArchitectInterface
{

  public function add(FormElement $element): static;

  public function get(string $name): FormElement;

  public function has(string $name): bool;

  public function remove(string $name): static;

  public function get_all(): array;

  public function build();

}