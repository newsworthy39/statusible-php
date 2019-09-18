<div class="row mx-auto ">
<div class="col-sm-8 py-2"><?php if ($user) { ?><a href="/sites/<?=$site->identifier?>/checks/new" class="btn btn-primary">Create Check</a><?php }?></div>
  <div class="col-sm-4 py-2 d-flex justify-content-end ">
    <form class="form-inline my-lg-0 ">
      <input class="form-control mr-sm-2" type="search" placeholder="Filter" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 " type="submit">Filter</button>
    </form>
  </div>
</div>
