<?php $this->layout('template', ['title' => sprintf("%s (profile)", $visiteduser->getNickname())]); ?>

<div class="container">

  <?php $this->insert('snippets/navigationbar'); ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <div class="list-group list-group-horizontal-sm flex-fill">
      <a href="?page=overview" class="list-group-item list-group-item-action <?php if ($page == 'overview') echo 'active'?>">Profile</a>
      <a href="?page=sites" class="list-group-item list-group-item-action <?php if ($page == 'sites') echo 'active'?>"">Sites</a>
      <a href="?page=teams" class="list-group-item list-group-item-action <?php if ($page == 'teams') echo 'active'?>"">Teams</a>
      <a href="?page=followers" class="list-group-item list-group-item-action <?php if ($page == 'followers') echo 'active'?>"">Followers</a>
    </div>
  </nav>

  <?php $this->insert(sprintf("profile/profile-snippets/%s", $page), ['visiteduser' => $visiteduser, 'user' => $user]); ?>

  <?php $this->insert('snippets/footer'); ?>
</div>