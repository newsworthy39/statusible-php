<?php $this->layout('template', ['title' => $site->identifier]) ?>

<div class="container">
  <?php $this->insert('snippets/navigationbar'); ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="list-group list-group-horizontal-sm flex-fill">
      <a href="?page=overview" class="list-group-item list-group-item-action <?php if ($page == 'overview') echo 'active'?>">Overview</a>
      <a href="?page=checks" class="list-group-item list-group-item-action <?php if ($page == 'checks') echo 'active'?>"">Checks</a>
      <a href="?page=history" class="list-group-item list-group-item-action <?php if ($page == 'history') echo 'active'?>"">history</a>
      <a href="?page=followers" class="list-group-item list-group-item-action <?php if ($page == 'followers') echo 'active'?>"">Followers</a>
    </div>
  </nav>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4"><?= $site->getIdentifier() ?> (<?= $site->Status() ?>)</h1>
    <p class="lead">We have the following checks registered, <?= $site->getUser()->getNickname() ?></p>
  </div>

  <div class="container px-3 pb-3" style="max-width:480px" >
  <ul class="list-group">
    <li class="list-group-item">Login-service</li>
    <li class="list-group-item">Primary webservices</li>
    <li class="list-group-item">Integration-services</li>
    <li class="list-group-item">Data-services</li>
    <li class="list-group-item">Streaming-services</li>
  </ul>
</div>

  <?php $this->insert('snippets/footer'); ?>
</div>