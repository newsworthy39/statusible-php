<?php $this->layout('template', ['title' => 'Dashboard']) ?>

<div class="container">

  <?php $this->insert('snippets/navigationbar'); ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="list-group list-group-horizontal-sm flex-fill">
      <a href="?page=overview" class="list-group-item list-group-item-action active">Profile</a>
      <a href="?page=teams" class="list-group-item list-group-item-action ">Teams</a>
      <a href="?page=followers" class="list-group-item list-group-item-action">Followers</a>
      <a href="?page=publicpages" class="list-group-item list-group-item-action">Public service pages</a>
    </div>
  </nav>

  <div class="container mx-n1 px-3 mt-3">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Shit and stuff</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $this->insert('snippets/footer'); ?>

</div>