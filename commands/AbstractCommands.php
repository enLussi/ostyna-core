<?php

namespace Ostyna\Component\Commands;


abstract class AbstractCommand {

  abstract public function execute(array $option = []);

}