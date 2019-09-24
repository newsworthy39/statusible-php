<?php

use newsworthy39\AuthMiddleware;

$this->layout('template', ['title' => 'sign-in or sign-up']) ?>

<div class="container">

  <?php $this->insert('template-snippets/navigationbar'); ?>

  <div class="jumbotron">
    <h1 class="display-4">Features</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <p class="lead ">
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </p>
  </div>

  <?php $this->insert('template-snippets/pricing', ['selectedEnabled' => false, 'plan' => false]); ?>

  <div class="jumbotron">
    <h1 class="display-4">Documentation</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <p class="lead ">
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </p>
  </div>


  <div class="jumbotron">
    <h1 class="display-4">Cookies!</h1>
    <p class="lead">We use cookies, to operate our website. When you create and account and log-in, you accept the use of cookies, to delivery the necessary functionality.</p>
    <hr class="my-4">
    <p>Cookies are necessary, to identify you to deliver our services.</p>
    <p class="lead ">
      <a class="btn btn-primary btn-lg" href="/cookies" role="button">Learn more about cookies here</a>
    </p>
  </div>

  <?php $this->insert('template-snippets/footer', ['acceptCookies' => false]); ?>
 
</div>