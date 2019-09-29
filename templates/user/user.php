<?php $this->layout('template', ['title' => sprintf("%s (profile)", $visiteduser->getIdentifier())]); ?>

<?php $this->insert('template-snippets/navigationbar'); ?>

<div class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
  <div class="list-group list-group-horizontal-sm flex-fill">
    <a href="/user/<?= $visiteduser->getIdentifier() ?>" class="list-group-item list-group-item-action <?php if ($page == 'overview') echo 'active' ?>">Profile</a>
    <a href="/user/<?= $visiteduser->getIdentifier() ?>?page=sites" class="list-group-item list-group-item-action <?php if ($page == 'sites') echo 'active' ?>"">Sites</a>
      <a href="/user/<?= $visiteduser->getIdentifier() ?>?page=teams" class="list-group-item list-group-item-action <?php if ($page == 'teams') echo 'active' ?>"">Teams</a>
      <a href="/user/<?= $visiteduser->getIdentifier() ?>?page=followers" class="list-group-item list-group-item-action <?php if ($page == 'followers') echo 'active' ?>"">Followers</a>
    </div>
</div>

<?php $this->insert(sprintf("user/user-snippets/%s", $page), ['visiteduser' => $visiteduser, 'user' => $user]); ?>