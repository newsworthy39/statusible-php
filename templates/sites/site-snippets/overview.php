<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-2 mt-2" >
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page" ><a href="/site/<?=$site->getIdentifier()?>"><?=$site->getIdentifier()?></a></li>
  </ol>
</nav>

<div class="bg-light">
<div class="px-3 py-3 media">
  <img src="<?=$site->getScreenShot()?>" class="mr-3 align-self-start class site-media" alt="...">
  <div class="media-body">
    <h5 class="mt-0"><?= $site->getIdentifier() ?>
    <p class="font-italic">from <?= $site->getOwner()->getIdentifier() ?></p></h5>
    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
  </div>
</div>
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