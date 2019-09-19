<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4"><?= $site->getIdentifier() ?></h1>
    <p class="lead font-italic">by <?= $site->getOwner()->getNickname() ?></p>
</div>

<div class="container px-3 pb-3" style="max-width:480px">
    <div class="list-group">
        <?php 
            $colors = [ 'success','warning','danger','light'];

            foreach ($site->Checks() as $check) {
            printf('<a href="/sites/%s/checks/%s" class="list-group-item list-group-item-action bg-%s text-white">%s (%s) <i>created %s</i></a>', 
                    $site->getIdentifier(),
                    $check->getIdentifier(), 
                    $colors[$check->getStatus()],
                    $check->getIdentifier(), 
                    $check->getTypeOfServiceHumanReadable(),
                    $check->getCreated()
            );
        }
        ?>
    </div>

</div>