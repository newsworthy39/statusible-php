<?php $this->layout('template', ['title' => 'Dashboard']) ?>

<div class="container">

  <?php $this->insert('template-snippets/navigationbar'); ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="list-group list-group-horizontal-sm flex-fill">
      <a href="?page=details" class="list-group-item list-group-item-action active">Account details</a>
      <a href="?page=privacy" class="list-group-item list-group-item-action">Account privacy</a>
      <a href="?page=api" class="list-group-item list-group-item-action">API identification</a>
      <a href="?page=apps" class="list-group-item list-group-item-action">Authorized Apps</a>
      <a href="?page=billing" class="list-group-item list-group-item-action">Billing</a>
    </div>
  </nav>

  <div class="container mx-n1 mt-3 px-3">
    <div class="row">
      <div class="col mb-3">
      <div class="card" style="min-width: 14rem">
          <div class="card-body">
            <h5 class="card-title">Personal information</h5>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?= $user->email ?>" readonly>
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col mb-3">
      <div class="card" style="min-width: 14rem">
          <div class="card-body">
            <h5 class="card-title">Change password</h5>
            <form method="POST" action="/token/<?= $user->token ?>/resetpassword">
              <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <label for="inputPassword" class="sr-only">New password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="New password" required autofocus>
                <label for="inputPasswordRepeat" class="sr-only">Repeat password</label>
                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm password" required>
                <input type="hidden" id="token" class="form-control" value="<?= $user->token ?>">
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
      if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
  </script>

  <?php $this->insert('template-snippets/footer'); ?>

</div>