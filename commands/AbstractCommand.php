<?php

namespace Ostyna\Component\Commands;


abstract class AbstractCommand {

  abstract public function execute(array $option = []);

  protected function delete_same_category_options(array $options, array $same_category_options) {
    return array_diff($options, $same_category_options);
  }

}