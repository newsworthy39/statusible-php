<div class="row mx-auto ">
<div class="col-sm-8 py-2"><?php if ($user) { ?><a href="/sites/create/new" class="btn btn-primary">Create site</a><?php }?></div>
  <div class="col-sm-4 py-2 d-flex justify-content-end ">
    <form class="form-inline my-lg-0 ">
      <input class="form-control mr-sm-2" type="search" placeholder="Filter" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 " type="submit">Filter</button>
    </form>
  </div>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Site</h1>
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
            <a href="/sites/<?= $site->getIdentifier() ?>" class="btn btn-primary">Visit site</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>