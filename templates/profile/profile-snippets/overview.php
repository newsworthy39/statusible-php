<nav aria-label="breadcrumb" class="py-2">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page" ><a href="/user/<?=$user->getIdentifier()?>"><?=$user->getIdentifier()?></a></li>
  </ol>
</nav>

<div class="pricing-header px-2 py-2 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Overview</h1>
  <p class="lead">We have the following checks, registered. Read the documentation <a href="/documentation/sites">about the sites</a> for more information.</p>
</div>

<div class="container mt-3 px-3">
  <div class="row">
    <?php foreach ($visiteduser->Sites() as $site) : ?>
      <div class="col mb-3">
        <div class="card" style="max-width: 26rem;">
          <img src="/assets/statusible-servicestatus-<?= $site->getServiceStatus() ?>-100x100.png?version=2" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title"><?= $site->identifier ?></h5>
            <p class="card-text">Service last checked ten minutes ago.</p>
            <a href="/sites/<?= $site->getIdentifier() ?>" class="btn btn-primary">View service</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

