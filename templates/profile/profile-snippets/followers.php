<div class="row mx-auto ">
  <div class="col-sm-8 py-2"></div>
  <div class="col-sm-4 py-2 d-flex justify-content-end ">
    <form class="form-inline my-lg-0">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        <button class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit">Filter</button>
      </div>
    </form>
  </div>
</div>




<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Followers</h1>
  <p class="lead">@<?= $user->getNickname() ?></p>
</div>

<div class="container mt-3 px-3">
  <div class="row">
    <?php foreach ($user->Sites() as $site) : ?>
      <div class="col mb-3">
        <div class="card" style="max-width: 26rem;">
          <img src="/assets/statusible-servicestatus-<?= $site->Status() ?>-100x100.png?version=2" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title"><?= $site->identifier ?></h5>
            <p class="card-text">Service last checked ten minutes ago.</p>
            <a href="/sites/<?= $site->id ?>" class="btn btn-primary">View service</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>