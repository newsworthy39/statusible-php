<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4"><?= $site->getServiceStatus() ?> <?= $site->getIdentifier() ?></h1>
    <p class="lead font-italic">by <?= $site->getOwner()->getNickname() ?></p>
</div>

<div class="container px-3 pb-3" style="max-width:480px">
    <div class="list-group">
        <?php foreach ($site->Checks() as $check) {
            printf('<a href="/sites/%s/checks/%s" class="list-group-item list-group-item-action bg-warning " >%s (%s) <i>created %s</i></a>', 
                    $site->getIdentifier(),
                    $check->getIdentifier(), 
                    $check->getIdentifier(), 
                    $check->getTypeOfServiceHumanReadable(),
                    $check->getCreated()
            );
        }
        ?>
    </div>

</div>