<?php $this->layout('template', ['title' => $site->identifier]) ?>

<div class="container">
  <?php $this->insert('snippets/navigationbar'); ?>

  <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Create site</h1>
    <p class="lead">A site, is the starting point, for your projects. Create a site, and assign checks later. Read the documentation <a href="/documentation/sites">about the sites</a> for more information.</p>
    <form class="form-createsite" METHOD="POST">
      <label for="inputNickname" class="sr-only">Site identifier</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon3">https://<?= $this->variables('site_title') ?>/sites/</span>
        </div>
        <input type="text" name="identifier" id="identifier" class="form-control" placeholder="Choose a site identifier" required autofocus>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Create site</button>
      </form>
  </div>

  <?php $this->insert('snippets/footer'); ?>
</div>