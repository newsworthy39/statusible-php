<nav aria-label="breadcrumb" class="my-2">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/user/<?=$user->getIdentifier() ?>"><?= $user->getIdentifier() ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="/user/<?= $user->getIdentifier() ?>?page=teams">Teams</a></li>
  </ol>
</nav>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Teams</h1>
  <p class="lead"><?=$user->getIdentifier()?> belongs to these teams. Read the documentation <a href="/documentation/teams">about teams</a> for more information.</p>
</div>


