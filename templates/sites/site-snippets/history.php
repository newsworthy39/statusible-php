<nav aria-label="breadcrumb" class="py-2">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="/sites/<?=$site->getIdentifier()?>"><?=$site->getIdentifier()?></a></li>
    <li class="breadcrumb-item active" aria-current="page" ><a href="/site/<?=$site->getIdentifier()?>?page=history">History</a></li>
  </ol>
  filter
</nav>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4"><?= $site->getIdentifier() ?></h1>
    <p class="lead font-italic">by <?= $site->getOwner()->getIdentifier() ?></p>
</div>

<div class="container px-2 pb-2 py-2" style="max-width:480px">
    <div class="list-group">
        <?php 
            $colors = [ 'success','warning','danger','light'];

            foreach ($site->Checks() as $check) {
            printf('<a href="/sites/%s/checks/%s/schedulecheck" class="list-group-item list-group-item-action bg-%s text-white">%s (%s) <i>updated %s</i></a>', 
                    $site->getIdentifier(),
                    $check->getIdentifier(), 
                    $colors[$check->getStatus()],
                    $check->getIdentifier(), 
                    $check->getTypeOfServiceHumanReadable(),
                    $check->getLastUpdated()
            );
        }
        ?>
    </div>
</div>