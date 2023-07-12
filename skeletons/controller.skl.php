<?= "<?php \n" ?>

namespace App\Controllers;

use Ostyna\Component\Framework\AbstractPageController;

class <?= $data['class'] ?> extends AbstractPageController 
{
  public function display() {
    return $this->render('/web/index_<?= $data['name'] ?>.html', [
      'controller' => "<?=  "Controller $data[class]" ?>",
    ]);
  }
}