<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4"><?= $site->StatusHumanReadable() ?> <?= $site->getIdentifier() ?></h1>
    <p class="lead font-italic">by <?= $site->getOwner()->getNickname() ?></p>
  </div>

  <div class="container px-3 pb-3" style="max-width:480px" >
  <ul class="list-group">
    <li class="list-group-item">Login-service</li>
    <li class="list-group-item">Primary webservices</li>
    <li class="list-group-item">Integration-services</li>
    <li class="list-group-item">Data-services</li>
    <li class="list-group-item">Streaming-services</li>
  </ul>
</div>