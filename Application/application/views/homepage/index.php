<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?= $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/'); ?>css/one-page-wonder.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('homepage') ?>">Invenventory</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/registration') ?>">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth') ?>">Log In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container">
                <h1 class="masthead-heading mb-0">
                    <i class="fas fa-fw fa-truck-moving"></i> Invenventory
                </h1>
                <h2 class="masthead-subheading mb-0">An Inventory Website For You</h2>
                <!-- <a href="#" class="btn btn-primary btn-xl rounded-pill mt-5">Learn More</a> -->
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5">
                        <img class="img-fluid rounded" src="<?= base_url('assets/'); ?>img/admin2.jpg" alt="" />
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">For those about to rock...</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
                            aliquid, mollitia odio veniam sit iste esse assumenda amet
                            aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="p-5">
                        <img class="img-fluid rounded-circle" src="<?= base_url('assets/'); ?>img/admin4.jpg" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2 class="display-4">We salute you!</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
                            aliquid, mollitia odio veniam sit iste esse assumenda amet
                            aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5">
                        <img class="img-fluid rounded-circle" src="<?= base_url('assets/'); ?>img/admin5.jpg" alt="" />
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Let there be rock!</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
                            aliquid, mollitia odio veniam sit iste esse assumenda amet
                            aperiam exercitationem, ea animi blanditiis recusandae! Ratione
                            voluptatum molestiae adipisci, beatae obcaecati.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg order-lg-2">
                    <div class="p-5">
                        <img class="img-fluid" src="<?= base_url('assets/'); ?>img/admin3.jpg" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-black">
        <div class="container">
            <p class="m-0 text-center text-white small">
                Copyright &copy; Inven-ven Inventory <?= date('Y'); ?>
            </p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>