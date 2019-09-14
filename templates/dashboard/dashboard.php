<?php $this->layout('template', ['title' => 'Dashboard']) ?>

<div class="container">

  <?php $this->insert('snippets/navigationbar', ['title' => 'Dashboard', 'signedIn' => true]); ?>

  <?php $this->insert('snippets/footer', ['acceptCookies' => false]); ?>

</div>