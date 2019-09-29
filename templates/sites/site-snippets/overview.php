<ol class="breadcrumb bg-light">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page"><a href="/site/<?= $site->getIdentifier() ?>"><?= $site->getIdentifier() ?></a></li>
</ol>

<div class="container">
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-pills card-header-pills">
        <li class="nav-item">
          <a class="nav-link active" href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <?php if ($user) : ?>
          <li class="nav-item">
            <a href="/sites/<?= $site->getIdentifier() ?>/settings" class="nav-link"><img src="/assets/svg/gear.svg" width=24></a>
          </li>
        <?php endif; ?>

      </ul>
  </div>
  <div class="row no-gutters">
    <div class="col-md-4 bg-light">
      <img src="<?= $site->getScreenShot() ?>" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $site->getIdentifier() ?></h5>
        <p class="card-text"><?= $site->getIdentifier() ?></p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Since <?= $site->getCreated() ?></li>
        <li class="list-group-item">from <?= $site->getOwner()->getIdentifier() ?></li>
      </ul>

    </div>
  </div>
</div>
</div>