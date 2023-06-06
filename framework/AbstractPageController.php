<?php

namespace Ostyna\Component\Framework;

use Ostyna\Component\Interface\PageInterface;
use Ostyna\Component\Traits\PageTrait;

abstract class AbstractPageController implements PageInterface {
  use PageTrait;
}