<?php $this->layout('template', ['title' => $site->identifier]) ?>

<div class="container">
  <?php $this->insert('snippets/navigationbar'); ?>

  <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="max-width:500px">
    <h1 class="display-4">Create check</h1>
    <p class="lead">A site, is the starting point, for your projects. Create a site, and assign checks later. Read the documentation <a href="/documentation/sites/checks">about the sites</a> for more information.</p>
    <form class="form-createsite" METHOD="POST">
      <label for="inputNickname" class="sr-only">check identifier</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon3">https://<?= $this->variables('site_title') ?>/sites/<?= $site->getIdentifier() ?>/</span>
        </div>
        <input type="text" name="identifier" id="identifier" class="form-control" placeholder="Choose a check identifier" required autofocus>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">What type of service, should the check examine?</label>
        <select class="form-control" name="typeofservice" id="exampleFormControlSelect1">
          <?php
          foreach (\newsworthy39\Check\Check::getSupportedServices() as $service) {
            echo printf("<option value='%s'>%s</option>", $service, $service);
          }

          ?>
        </select>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Create check</button>
    </form>
  </div>

  <?php $this->insert('snippets/footer'); ?>
</div>