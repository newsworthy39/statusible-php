<?php $this->layout('template', ['title' => $exception->getMessage()]) ?>

<div class="container">
  <?php $this->insert('snippets/navigationbar'); ?>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">404 Not found </h1>
    <p class="lead">But statusible.com, is still affordable and easy. Check the <a href="/features">features-list</a> for more information.</p>
  </div>

  <?php $this->insert('snippets/footer'); ?>
  
</div>