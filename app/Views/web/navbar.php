<!-- Start Preloader Area -->
    <!-- <div class="preloader-area">
        <div class="preloader">
            <div class="loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div> -->
    <!-- End Preloader Area -->

    <!-- Start Navbar Area -->
    <div class="navbar-area header-sticky">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarNavDropdown" class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#home" target="_blank">Inicio</a></li>
                        <?php foreach ($secciones as $key => $secc) { ?>
                            <?php if ($secc->txt_btn) { ?>
                                <li class="nav-item"><a class="nav-link" href="<?= $secc->link_secc ?>"><?= $secc->txt_btn ?></a></li>
                            <?php }; ?>
                        <?php }; ?>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Navbar Area -->

    <div class="alert-content"></div>