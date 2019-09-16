<?php $this->layout('template', ['title' => 'Checks overview']) ?>

<div class="container">

  <?php $this->insert('snippets/navigationbar'); ?>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Site</h1>
    <p class="lead">We have the following checks, registered. Read the documentation <a href="/documentation/checks">about the checks</a> for more information.</p>
  </div>

  <div class="container mt-3 px-3">
    <div class="row">
      <?php foreach ($user->Sites() as $site) : ?>
        <div class="col mb-3">
        <div class="card" style="max-width: 26rem;">
          <img src="/assets/statusible-servicestatus-<?=$site->Status()?>-100x100.png?version=2" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?= $site->identifier ?></h5>
              <p class="card-text">Service last checked ten minutes ago.</p>
              <a href="/user/<?=$user->NickName()?>/checks/<?=$check->id?>" class="btn btn-primary">View service</a>             
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php $this->insert('snippets/footer'); ?>
  </div>