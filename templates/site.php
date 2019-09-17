<?php $this->layout('template', ['title' => $site->identifier]) ?>

<div class="container">
  <?php $this->insert('snippets/navigationbar'); ?>

  <?=$site->Status() ?>

  <?php $this->insert('snippets/footer'); ?>
</div>