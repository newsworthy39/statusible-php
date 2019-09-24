<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Pricing</h1>
    <?php if (!$selectedEnabled) { ?>
    <p class="lead">Affordable and easy. Statusible.com, lets you monitor service health and engage customers on incidents. Check the <a href="/features">features-list</a> for more information.</p>
    <?php } ?>
    <p class="small font-weight-bolder">You can change your plan anytime, based on your needs and preferences. </p>
    
</div>

<div class="card-deck mb-3 text-center">
    <?php if ($plan == 'starter' && $selectedEnabled) { ?>
        <div class="card mb-4 shadow-sm border border-primary">
    <?php } else { ?>
        <div class="card mb-4 shadow-sm border ">
    <?php } ?>
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Starter</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>1 user</li>
                <li>512 mb of storage</li>
                <li>Service-checks included</li>
                <li>5 Service-pages included</li>
                <li>Help center access</li>
            </ul>
            <a href="/user/signup?plan=starter"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button></a>
        </div>
    </div>
    <?php if ($plan == 'standard' && $selectedEnabled ) { ?>
        <div class="card mb-4 shadow-sm border border-primary">
    <?php } else { ?>
        <div class="card mb-4 shadow-sm border ">
    <?php } ?>
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Standard</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>Team support</li>
                <li>20 users included</li>
                <li>20 checks included</li>
                <li>5 Service-pages included</li>
                <li>5 GB of storage</li>
                <li>Company branding options</li>
                <li>Priority email support</li>
                <li>Help center access</li>
            </ul>
            <a href="/user/signup?plan=standard"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Get started with a 14-day trial</button></a>
        </div>
    </div>
    <?php if ($plan == 'advanced' && $selectedEnabled) { ?>
        <div class="card mb-4 shadow-sm border border-primary">
    <?php } else { ?>
        <div class="card mb-4 shadow-sm border ">
    <?php } ?>
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Advanced</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$39 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>Team support</li>
                <li>Service-pages included</li>
                <li>Service-checks included</li>
                <li>15 GB of storage</li>
                <li>Company branding options</li>
                <li>Phone and email support</li>
                <li>Help center access</li>
            </ul>
            <a href="/user/signup?plan=advanced"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Get started with a 14-day trial</button></a>
        </div>
    </div>
    <?php if ($plan == 'professional' && $selectedEnabled) { ?>
        <div class="card mb-4 shadow-sm border border-primary">
    <?php } else { ?>
        <div class="card mb-4 shadow-sm border ">
    <?php } ?>
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Professional</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">$79 <small class="text-muted">/ mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                <li>Team support</li>
                <li>Service-pages included</li>
                <li>Service-checks included</li>
                <li>15 GB of storage</li>
                <li>Company branding options</li>
                <li>Phone and email support</li>
                <li>Help center access</li>
            </ul>
            <a href="/user/signup?plan=professional"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Get started with a 14-day trial</button></a>
        </div>
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">Enterprise</h4>
        </div>
        <div class="card-body">

            <h2> Our team will help you build a custom plan, that matches your companyss need.</h2>
            <a href="/contactus?plan=enterprise"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Contact us</button></a>
        </div>
    </div>
</div>