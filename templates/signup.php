<?php $this->layout('template', ['title' => 'signup']) ?>


  <?php $this->insert('template-snippets/navigationbar'); ?>

  <ol class="breadcrumb bg-light">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  <li class="breadcrumb-item"><a href="<?=$_REQUEST['URI']?>">Signup</a></li>
</ol>

  <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="max-width:480px">
    <h1 class="display-4">Signup</h1>
    <p class="lead">Signup only requires a working e-mail address. We will send you a confirmation e-mail, with your login-link, shortly after registration.</p>
    <form class="form-signin" METHOD="POST">
      <label for="inputNickname" class="sr-only">Nickname</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon3">https://<?= $this->variables('site_title') ?>/user/</span>
        </div>
        <input type="text" name="nickname" id="inputNickname" class="form-control" placeholder="Choose a nickname" required autofocus>
      </div>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <br />
      <input type="hidden" name="preferredplan" value="<?=$plan?>">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
      </form>
  </div>

  <?php $this->insert('template-snippets/pricing', ['selectedEnabled' => true]) ?>