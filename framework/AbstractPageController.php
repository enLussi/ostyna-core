<?php

namespace Ostyna\Component\Framework;

use Ostyna\Component\Interface\PageInterface;
use Ostyna\Component\Traits\PageTrait;

abstract class AbstractPageControlller implements PageInterface {
  use PageTrait;

  public function send_view() {

    echo "<!DOCTYPE html><html>".$this->content."</html>";

  }
}