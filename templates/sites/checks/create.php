<?php $this->layout('template', ['title' => $site->identifier]) ?>

<div class="container">
  <?php $this->insert('template-snippets/navigationbar'); ?>

  <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="max-width:500px">
    <h1 class="display-4">Create check</h1>
    <p class="lead">A check is the active or passive components, that your site is made up out of. Read the documentation <a href="/documentation/sites/checks">about the checks</a> for more information.</p>
    <form class="form-createsite" METHOD="POST">
      <label for="inputNickname" class="sr-only">check identifier</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon3">https://<?= $this->variables('site_title') ?>/sites/<?= $site->getIdentifier() ?>/</span>
        </div>
        <input type="text" name="identifier" id="identifier" class="form-control" placeholder="Choose a check identifier" required autofocus>
      </div>
      <div class="form-group">
        <label for="FormControlSelect1">What kind of check is this? An active check is performed, by our platform, whereas a passive check is populated via the API.</label>
        <select class="form-control" name="typeofcheck" id="exampleFormControlSelect1">
          <?php
          foreach (\newsworthy39\Check\Check::getSupportedTypeOfChecks() as $checktype) {
            echo printf("<option value='%s'>%s</option>", $checktype, $checktype);
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="FormControlSelect2">What type of service, should the check examine?</label>
        <select class="form-control" name="typeofservice" id="exampleFormControlSelect2">
          <?php
          foreach (\newsworthy39\Check\Check::getSupportedServices() as $service) {
            echo printf("<option value='%s'>%s</option>", $service, $service);
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="endpoint">Endpoint?</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">://</span>
          </div>
          <input type="text" name="endpoint" id="endpoint" class="form-control" placeholder="Enter check endpoint" required autofocus>
        </div>
      </div>
      <div class="form-group">
        <label for="checkIntervalSelect">How often?</label>
        <select class="form-control" name="checkinterval" id="checkIntervalSelect">
          <?php
          foreach (\newsworthy39\Check\Check::getSupportedCheckInterval() as $interval) {
            echo printf("<option value='%s'>%s</option>", $interval, $interval);
          }
          ?>
        </select>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Create check</button>
    </form>
  </div>

  <?php $this->insert('template-snippets/footer'); ?>
</div>