<?php $this->layout('template', ['title' => $site->identifier]) ?>

<div class="container">
  <?php $this->insert('snippets/navigationbar'); ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="list-group list-group-horizontal-sm flex-fill">
      <a href="?page=overview" class="list-group-item list-group-item-action <?php if ($page == 'overview') echo 'active'?>">Overview</a>
      <a href="?page=checks" class="list-group-item list-group-item-action <?php if ($page == 'checks') echo 'active'?>"">Checks</a>
      <a href="?page=history" class="list-group-item list-group-item-action <?php if ($page == 'history') echo 'active'?>"">history</a>
      <a href="?page=followers" class="list-group-item list-group-item-action <?php if ($page == 'followers') echo 'active'?>"">Followers</a>
      <?php if ($user):  ?>
      <a href="/sites/berlingskedk/settings" class="list-group-item list-group-item-action <?php if ($page == 'settings') echo 'active'?>"">Settings</a>
      <?php endif; ?>
    </div>
  </nav>

  <?php $this->insert(sprintf("sites/site-snippets/%s", $page), ['user' => $user, 'site' => $site]); ?> 

  <?php $this->insert('snippets/footer'); ?>
</div>