<?php $this->layout('template', ['title' => 'signup']) ?>

<div class="container">

  <?php $this->insert('snippets/navigationbar'); ?>

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

  <?php $this->insert('snippets/pricing', ['selectedEnabled' => true]) ?>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <small class="d-block mb-3 text-muted">&copy; <?php echo date("Y"); ?></small>
      </div>
      <div class="col-6 col-md">
        <h5>Features</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Cool stuff</a></li>
          <li><a class="text-muted" href="#">Random feature</a></li>
          <li><a class="text-muted" href="#">Team feature</a></li>
          <li><a class="text-muted" href="#">Stuff for developers</a></li>
          <li><a class="text-muted" href="#">Another one</a></li>
          <li><a class="text-muted" href="#">Last time</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Resources</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Resource</a></li>
          <li><a class="text-muted" href="#">Resource name</a></li>
          <li><a class="text-muted" href="#">Another resource</a></li>
          <li><a class="text-muted" href="#">Final resource</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>About</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Team</a></li>
          <li><a class="text-muted" href="#">Locations</a></li>
          <li><a class="text-muted" href="#">Privacy</a></li>
          <li><a class="text-muted" href="#">Terms</a></li>
        </ul>
      </div>
    </div>
  </footer>
</div>