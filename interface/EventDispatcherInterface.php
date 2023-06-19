<?php

namespace Ostyna\Component\Interface;

interface EventDispatcherInterface 
{
  public function dispatch($name, $object = null);

  public function addListener(string $name, $method, $listener = null, $argument = null, string $plugin = "");
}