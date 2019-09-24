<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php if ($user) { ?>
    <a class="navbar-brand" href="/user/<?= $user->getIdentifier() ?>"> <img src="<?=$user->getAvatar(32)?>" width="32" height="32" class="d-inline-block align-top" alt=""></a>
  <?php } else { ?>
    <a class="navbar-brand" href="/"> <img src="/assets/statusible-100x100.png" width="32" height="32" class="d-inline-block align-top" alt=""></a>
  <?php } ?>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <?php if (!$user) { ?>
        <li class="nav-item ">
          <a class="nav-link" href="/user/signin">Signin</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/user/signup">Signup</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/features">Features</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/support">Support</a>
        </li>
      <?php } ?>

      <?php if ($user) { ?>
        <li class="nav-item ">
          <a class="nav-link" href="/user/<?= $user->nickname ?>/dashboard">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/notifications">Notifications <span class="badge badge-primary"><?= $user->getNotifications() ?></span></a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="nav-item ">
          <a class="nav-link" href="/user/<?= $user->getIdentifier() ?>/settings">Account settings</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/user/signout">Signout</a>
        </li>
      <?php } ?>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="get" action="/search">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>