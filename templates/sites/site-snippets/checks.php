<nav aria-label="breadcrumb" class="py-2">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/site/<?=$site->getIdentifier()?>"><?=$site->getIdentifier()?></a></li>
    <li class="breadcrumb-item active" aria-current="page" ><a href="/site/<?=$site->getIdentifier()?>?page=checks">Checks</a></li>
  </ol>
</nav>

<div class="row mx-auto ">
  <div class="col-sm-8 py-2"><?php if ($user) { ?><a href="/sites/<?= $site->identifier ?>/checks/new" class="btn btn-primary">Create Check</a><?php } ?></div>
  <div class="col-sm-4 py-2 d-flex justify-content-end ">
    <form class="form-inline my-lg-0 ">
      <input class="form-control mr-sm-2" type="search" placeholder="Filter" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 " type="submit">Filter</button>
    </form>
  </div>
</div>

<div class="container px-2 pb-3 py-2">
  <?php foreach ($site->Checks() as $check) : ?>
    <div class="card" style="width: 18rem;">
      <img src="/assets/statusible-servicestatus-<?= $check->getStatus() ?>-100x100.png?version=2" class="card-img-top">
      <div class="card-body">
        <h5 class="card-title"><?= $check->getIdentifier() ?></h5>
        <p class="card-text"><?= $check->getTypeOfServiceHumanReadable() ?> check last updated <?= $check->getLastUpdated() ?></p>
        <a href="<?= sprintf("/sites/%s/checks/%s/settings", $site->getIdentifier(), $check->getIdentifier()); ?>" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>