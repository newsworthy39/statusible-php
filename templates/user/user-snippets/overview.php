<ol class="breadcrumb bg-light">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page"><a href="/user/<?= $visiteduser->getIdentifier() ?>"><?= $visiteduser->getIdentifier() ?></a></li>
</ol>

<div class=" pricing-header px-2 py-2 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Overview</h1>
  <p class="lead">We have the following checks, registered. Read the documentation <a href="/documentation/sites">about the sites</a> for more information.</p>
</div>

<div class="container">
  <div class="row">
    <?php foreach ($visiteduser->Sites() as $site) : ?>
      <div class="col mb-3">
        <div class="card border-0" style="max-width: 20rem;">
          <img src="<?= $site->getScreenShot() ?>" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title"><?= $site->identifier ?></h5>
            <p class="card-text">Since <?= $site->getCreated()?>.</p>
            <a href="/sites/<?= $site->getIdentifier() ?>" class="btn btn-primary">View service</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>