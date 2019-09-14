<?php $this->layout('template', ['title' => 'Dashboard']) ?>

<div class="container">

  <?php $this->insert('snippets/navigationbar', ['title' => sprintf("%s / %s", $this->variables('site_title'), 'dashboard')]); ?>

  <?php $this->insert('snippets/footer'); ?>

</div>