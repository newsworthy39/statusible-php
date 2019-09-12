<?php $this->layout('template', ['title' => 'sign-in']) ?>

<div class="container">
<div class="d-flex flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/"><?= $this->variables('site_title') ?></a></h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="#">Features</a>
    <a class="p-2 text-dark" href="#">Enterprise</a>
    <a class="p-2 text-dark" href="#">Support</a>
    <a class="p-2 text-dark" href="#">Pricing</a>
  </nav>
    <a class="btn btn-outline-primary" href="/user/signup">Sign up</a>
</div>

<div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-5">Signin</h1>
  <p class="lead">Use the credentials provided, when you signed up.</p>
    <form class="form-signin" METHOD="POST">
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="password" required>
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>      
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
</div>
</div>


