<?php $this->layout('template', ['title' => $site->identifier]) ?>

<?php $this->insert('template-snippets/navigationbar'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
  <div class="list-group list-group-horizontal-sm flex-fill">
    <a href="?page=overview" class="list-group-item list-group-item-action <?php if ($page == 'overview') echo 'active' ?>">Overview</a>
    <a href="?page=checks" class="list-group-item list-group-item-action <?php if ($page == 'checks') echo 'active' ?>">Checks</a>
    <a href="?page=history" class="list-group-item list-group-item-action <?php if ($page == 'history') echo 'active' ?>">history</a>
    <a href="?page=followers" class="list-group-item list-group-item-action <?php if ($page == 'followers') echo 'active' ?>">Followers</a>
  </div>
</nav>

<ol class=" breadcrumb bg-light">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  <li class="breadcrumb-item"><a href="/sites/<?= $site->getIdentifier() ?>"><?= $site->getIdentifier() ?></a></li>
  <li class="breadcrumb-item active" aria-current="page"><a href="<?=$_SERVER['URI']?>">Settings</a></li>
</ol>

<div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="<?= $site->getScreenshot() ?>" alt="" width="72" height="72">
    <h2>Settings</h2>
    <p class="lead">https://<?= $this->variables('site_title') ?>/sites/<?= $site->getIdentifier() ?>/</span></p>
  </div>
  <form class="form-editsite" METHOD="POST">
    <div class="row">
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">General settings</h4>
        <form class="needs-validation" novalidate>

          <div class="mb-3">
            <label for="screenshot">Choose screenshot</label>
            <div class="input-group">
              <input type="text" class="form-control" id="username" placeholder="Username" required>
              <div class="invalid-feedback" style="width: 100%;">
                Your username is required.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="username">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control" id="username" placeholder="Username" required>
              <div class="invalid-feedback" style="width: 100%;">
                Your username is required.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com">
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
            <div class="invalid-feedback">
              Please enter your shipping address.
            </div>
          </div>

          <div class="mb-3">
            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
          </div>

          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">Country</label>
              <select class="custom-select d-block w-100" id="country" required>
                <option value="">Choose...</option>
                <option>United States</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="state">State</label>
              <select class="custom-select d-block w-100" id="state" required>
                <option value="">Choose...</option>
                <option>California</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="zip">Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>



          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
      </div>
    </div>
</div>