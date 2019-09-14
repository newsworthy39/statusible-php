<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between " aria-label="breadcrumb">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <a class="navbar-brand" href="#"> <img src="/assets/statusible-100x100.png" width="32" height="32" class="d-inline-block align-top" alt=""></a>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>

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
          <a class="nav-link" href="/dashboard">Dashboard</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/notifications">Notifications <span class="badge badge-primary"><?= $notifications ?></span></a>
        </li>

        <li class="nav-item ">
          <a class="nav-link " href="/teams">Teams <span class="badge badge-primary">4</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sites
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>

        <li class="nav-item ">
          <a class="nav-link" href="/user/<?= $user->nickname ?>">Account settings</a>
        </li>

        <div class="dropdown-divider"></div>

        <li class="nav-item ">
          <a class="nav-link" href="/user/signout">Signout</a>
        </li>
      <?php } ?>
    </ul>
    <div class="dropdown-divider"></div>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>