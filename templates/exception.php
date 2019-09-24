<?php $this->layout('template', ['title' => $exception->getMessage()]) ?>

<div class="container">
  <?php $this->insert('template-snippets/navigationbar'); ?>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4"><?=$exception->getStatusCode()?> - <?=$exception->getMessage()?><h1>
    <p class="lead">But statusible.com, is still affordable and easy. Check the <a href="/features">features-list</a> for more information.</p>
  </div>

  <?php $this->insert('template-snippets/footer'); ?>
  
</div>