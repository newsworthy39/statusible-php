<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, min-width:330px">

  <meta name="description" content="Statusible.com, is used to monitor services across the internet. Share your built services, and let other subscribe as part of their service-integration portfolio, to aid in debugging and operating their own services" />
  <meta property="og:title" content="<?= $this->variables('site_title') ?> | <?= $this->e($title) ?>" />
  <meta property="og:type" content="website" />
  <meta property="lp:type" content="frontpage" />
  <meta property="og:description" content="Statusible.com, is used to monitor services across the internet. Share your built services, and let other subscribe as part of their service-integration portfolio, to aid in debugging and operating their own services" />
  <meta property="og:url" content="http://<?= $this->variables('site_title') ?>" />
  <meta property="og:image" content="/assets/statusible-overview.png" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/assets/bootstrap.min.css">

  <style>
    html {
      font-size: 14px;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .site-media {
      height: auto;
      max-width: 240px
    }

    @media (min-width: 768px) {
      html {
        font-size: 16px;
      }

      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    @media(max-width: 330px) {
      .card-deck {
        margin-left: -15px;
        margin-right: -15px;
      }

      .site-media {
        height: auto;
        max-width: 120px
      }
    }

    .pricing-header {
      max-width: 700px;
    }

    .card-deck {
      margin-left: 0px;
      margin-right: 0px;
    }

    .container-fluid {
      padding: 0px;
    }

    footer {
      padding-top: 15px;
      padding-left: 15px;
      padding-right: 15px;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      min-height: 400px;
      background-color: #f5f5f5;
    }

    .body {
      min-height: 40rem;
    }
  </style>
  <title><?= $this->variables('site_title') ?> | <?= $this->e($title) ?></title>

</head>

<body>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <div class="container-fluid">
    <div class="body">
      <?= $this->section('content') ?>
    </div>
    <footer>
      <div class="row">
        <div class="col-12 col-md">
          <small class="d-block mb-3 text-muted">&copy; <?php echo date("Y"); ?></small>
        </div>
        <div class="col-6 col-md">
          <h5>Features</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Cool stuff</a></li>
            <li><a class="text-muted" href="#">Random feature</a></li>
            <li><a class="text-muted" href="#">Team feature</a></li>
            <li><a class="text-muted" href="#">Stuff for developers</a></li>
            <li><a class="text-muted" href="#">Another one</a></li>
            <li><a class="text-muted" href="#">Last time</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Resource</a></li>
            <li><a class="text-muted" href="#">Resource name</a></li>
            <li><a class="text-muted" href="#">Another resource</a></li>
            <li><a class="text-muted" href="#">Final resource</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>About</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Team</a></li>
            <li><a class="text-muted" href="#">Locations</a></li>
            <li><a class="text-muted" href="#">Privacy</a></li>
            <li><a class="text-muted" href="#">Terms</a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>

</body>

</html>