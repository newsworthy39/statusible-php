<?php $this->layout('template', ['title' => sprintf("%s (dashboard)", $user->getIdentifier())]); ?>

<div class="container">

  <?php $this->insert('snippets/navigationbar'); ?>

  * Service overview

  * News from statusible.com

  * Number of notifications  

  <?php $this->insert('snippets/footer'); ?>

</div>