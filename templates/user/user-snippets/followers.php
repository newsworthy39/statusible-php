<ol class="breadcrumb bg-light">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  <li class="breadcrumb-item"><a href="/user/<?= $visiteduser->getIdentifier() ?>"><?= $visiteduser->getIdentifier() ?></a></li>
  <li class="breadcrumb-item active" aria-current="page"><a href="/user/<?= $visiteduser->getIdentifier() ?>?page=followers">Followers</a></li>
</ol>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Followers</h1>
  <p class="lead"><?= $visiteduser->getIdentifier() ?> has these followers. Read the documentation <a href="/documentation/followers">about followers</a> for more information.</p>
</div>