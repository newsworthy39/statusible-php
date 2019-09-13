<?php $this->layout('template', ['title' => 'sign-in or sign-up']) ?>

<div class="container">
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/"><?= $this->variables('site_title') ?></a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="#">Features</a>
      <a class="p-2 text-dark" href="#">Enterprise</a>
      <a class="p-2 text-dark" href="#">Support</a>
    </nav>
    
    <a class="btn btn-outline-primary" href="/user/signin">Sign in</a>&nbsp;
    <a class="btn btn-outline-primary" href="/user/signup">Sign up</a>
  </div>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Pricing</h1>
    <p class="lead">Affordable and easy. Statusible.com, lets you monitor service health and engage customers on incidents. Check the <a href="/features">features-list</a> for more information.</p>
  </div>

  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Free for personal use</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>1 user</li>
          <li>512 mb of storage</li>
          <li>Service-checks included</li>
          <li>5 Service-pages included</li>
          <li>Help center access</li>
        </ul>
        <a href="/user/signup"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button></a>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Professionel</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Team support</li>
          <li>20 users included</li>
          <li>20 checks included</li>
          <li>5 Service-pages included</li>
          <li>5 GB of storage</li>
          <li>Company branding options</li>
          <li>Priority email support</li>
          <li>Help center access</li>
        </ul>
        <a href="/signup"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Get started</button></a>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Enterprise</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Team support</li>
          <li>Service-pages included</li>
          <li>Service-checks included</li>
          <li>15 GB of storage</li>
          <li>Company branding options</li>
          <li>Phone and email support</li>
          <li>Help center access</li>
        </ul>
        <a href="/user/signup"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Contact us</button></a>
      </div>
    </div>
  </div>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <img class="mb-2" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
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