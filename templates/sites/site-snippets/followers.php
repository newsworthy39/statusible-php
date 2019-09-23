<nav aria-label="breadcrumb" class="py-2">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/site/<?=$site->getIdentifier()?>"><?=$site->getIdentifier()?></a></li>
    <li class="breadcrumb-item active" aria-current="page" ><a href="/site/<?=$site->getIdentifier()?>?page=followers">Followers</a></li>
  </ol>
</nav>

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
