<ol class="breadcrumb bg-light">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  <li class="breadcrumb-item"><a href="/sites/<?= $site->getIdentifier() ?>"><?= $site->getIdentifier() ?></a></li>
  <li class="breadcrumb-item active" aria-current="page"><a href="/site/<?= $site->getIdentifier() ?>?page=checks">Checks</a></li>
</ol>


<div class="mt-3 mx-0 row">
  <div class="col">
    <form class="form-inline">
      <input class="form-control" type="search" placeholder="Filter" aria-label="Search">
      <button class="btn btn-outline-success ml-2" type="submit">Filter</button>
    </form>
  </div>
  <div class="col text-right">
    <?php if ($user) : ?>
      <a href="/sites/<?= $site->identifier ?>/checks/new" class="btn btn-primary">Create Check</a>
    <?php endif; ?>
  </div>
</div>

<div class="px-3 pt-3">
  <div class="row">
    <?php
    $colors = ['success', 'warning', 'danger', 'light'];
    $number = 1;
    $max = 5;
    foreach ($site->Checks() as $check) {
      if ($number++ % $max == 0) {
        print('<div class="w-100"></div>');
      }
      ?>
      <div class="col-sm">
        <div class="card text-white bg-success mb-3" style="max-width: 25rem;">
          <div class="card-header">Check OK</div>
          <div class="card-body">
            <h4 class="card-title"><?= $check->getIdentifier() ?></h4>
            <p class="card-text"><?= $check->getTypeOfServiceHumanReadable() ?> check last updated <?= $check->getLastUpdated() ?></p>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>