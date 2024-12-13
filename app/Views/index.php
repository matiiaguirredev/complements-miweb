

<!-- Start Parallax Home Area -->
<div id="home" class="main-banner parallax">
    <?php /* debug($perfil, false); */ ?> 
    <style>
        .main-banner {
            background-image: url(<?= $perfil->img_fondo; ?>);
        }
    </style>
    <div class="parallax-home"></div>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="main-banner-text parallax-home-text">
                            <h1 class="animated-text"></h1>
                            <ul>
                                <?php foreach ($redes as $key => $red) : ?>
                                    <li><a href="<?= $red->url ?>" target="_blank"><?= $red->iconHTML ?></a></li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5">
                        <div class="parallax-home-img">
                            <img class="img-fluid imgindex" src="<?= $perfil->img ?>" alt="me">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="ca3-scroll-down-link ca3-scroll-down-arrow" data-ca3_iconfont="ETmodules" data-ca3_icon="" href="#about"></a>
</div>
<!-- End Parallax Home Area -->