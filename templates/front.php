<?php $this->layout('template', ['title' => 'welcome']) ?>

<h1><?=$this->variables('site_title')?> </h1>
<p>Hello, <?=$this->e($name)?></p>