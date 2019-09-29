
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/user/<?= $visiteduser->getIdentifier() ?>"><?= $visiteduser->getIdentifier() ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="/user/<?= $visiteduser->getIdentifier() ?>?page=sites">Sites</a></li>
  </ol>


<?php if ($user): ?>
<div class="row mx-0 px-3 text-right">
  <div class="col"><a href="/sites/create/new" class="btn btn-primary">Create site</a></div>
</div>
<?php endif; ?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Site</h1>
  <p class="lead">We have the following checks, registered. Read the documentation <a href="/documentation/sites">about the sites</a> for more information.</p>
</div>

<div class="mt-3 px-3">
  <div class="row">
    <?php foreach ($visiteduser->Sites() as $site) : ?>
      <div class="col mb-3 ">
        <div class="card " style="max-width: 26rem;">
          <img src="<?= $site->getScreenShot() ?>" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title"><?= $site->identifier ?></h5>
            <p class="card-text">Service last checked ten minutes ago.</p>
            <a href="/sites/<?= $site->getIdentifier() ?>" class="btn btn-primary">Visit site</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>