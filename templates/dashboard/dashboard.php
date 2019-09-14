<?php $this->layout('template', ['title' => 'Dashboard']) ?>

<div class="container">

  <?php $this->insert('snippets/navigationbar'); ?>

  <div class="container mx-n1 px-3 mt-3">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sites</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col mb-3">
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Checks</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col mb-3">
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Pages</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
      <div class="col mb-3">
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Teams</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $this->insert('snippets/footer'); ?>

</div>