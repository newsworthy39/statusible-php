<?php $this->layout('template', ['title' => 'sign-in']) ?>


<?php $this->insert('template-snippets/navigationbar'); ?>

<ol class="breadcrumb bg-light">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  <li class="breadcrumb-item"><a href="<?=$_REQUEST['URI']?>">Signin</a></li>
</ol>

<div class="container py-3" style="max-width: 540px">
  <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="max-width:480px">
    <h1 class="display-4">Signin</h1>
    <p class="lead">Use the credentials provided, when you <a href="/user/signup">signed up</a>.</p>
    <form class="form-signin" METHOD="POST">

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      
      <label for="inputPassword" class="sr-only">password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="password" required>
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y"); ?></p>
    </form>
  </div>
</div>