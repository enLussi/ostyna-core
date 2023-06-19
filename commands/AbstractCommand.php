<?php

namespace Ostyna\Component\Commands;

use Ostyna\Component\Utils\CoreUtils;

abstract class AbstractCommand {

  abstract public function execute(array $option = []);

  protected function delete_same_category_options(array $options, array $same_category_options) {
    return array_diff($options, $same_category_options);
  }

  protected function generate_by_skeleton (string $skeleton, array $data = []): string {

    $generated = "";
    $skeletons = $this->get_skeletons();
    if(isset($skeletons[$skeleton])){
      ob_start();
      include $skeletons[$skeleton];
      $generated = ob_get_clean();
    }

    return $generated;
  }

  private function get_skeletons (): array {
    $skeleton_files = [];

    $vendor_directory = CoreUtils::get_project_root().'/vendor';

    if(is_dir($vendor_directory)) {

      $package_directories = glob($vendor_directory . '/ostyna/*', GLOB_ONLYDIR);

      foreach($package_directories as $package) {
        $package_skeletons = $package.'/skeletons';

        if(is_dir($package_skeletons)) {
          $skeletons = scandir($package_skeletons);
          $skeletons = array_diff($skeletons, ['.','..']);
          foreach($skeletons as $s) {
            if(is_file($package_skeletons.'/'.$s)) {
              $skeleton_files[$s] = $package_skeletons.'/'.$s;
            }
          }
        }
      }
    }

    return $skeleton_files;
  }

}