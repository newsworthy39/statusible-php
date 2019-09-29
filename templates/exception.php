<?php $this->layout('template', ['title' => $exception->getMessage()]) ?>


<?php $this->insert('template-snippets/navigationbar'); ?>

<ol class="breadcrumb bg-light">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  <li class="breadcrumb-item"><a href="/"><?= $exception->getMessage() ?></a></li>
</ol>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4"><?= $exception->getStatusCode() ?> - <?= $exception->getMessage() ?><h1>
      <p class="lead">But statusible.com, is still affordable and easy. Check the <a href="/features">features-list</a> for more information.</p>
</div>