<?php

use newsworthy39\AuthMiddleware;

$this->layout('template', ['title' => 'search results']) ?>

<div class="container">

  <?php $this->insert('template-snippets/navigationbar'); ?>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Results found</h1>
  </div>

  <div class="container mt-3 px-3">
    <div class="row">

      <?php foreach ($siteResults as $site) : ?>
        <div class="col mb-3">
          <div class="card" style="max-width: 26rem;">
            <img src="<?=$site->getScreenShot()?>" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?= $site->identifier ?></h5>
              <p class="card-text">Service last checked ten minutes ago.</p>
              <a href="/sites/<?= $site->getIdentifier() ?>" class="btn btn-primary">Visit site</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="w-100"></div>

      <?php foreach ($userResults as $user) : ?>
        <div class="col mb-3">
          <div class="card" style="max-width: 26rem;">
            <div class="card-body">
              <img src="<?=$user->getAvatar(240)?>"" class="card-img-top">
              <h5 class="card-title"><?= $user->getIdentifier() ?></h5>
              <p class="card-text">User since <?= $user->getCreated() ?></p>
              <a href="/user/<?= $user->getIdentifier() ?>" class="btn btn-primary">Visit user</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>


  <?php $this->insert('template-snippets/footer', ['acceptCookies' => false]); ?>

</div>