        <!-- Start Portfolio Area -->
        <section id="works" class="portfolio-area ptb-80">
            <div class="container">
                <div class="section-title">
                    <h2><?= $titulos ?></h2>
                    <style>
                        .portfolio-area {
                            /* background-color: <?= $bg_color ?>; */
                        }
                    </style>
                    <h3><?= $titulos ?></h3>
                    <p><?= $descripciones ?></p>
                </div>

                <div class="row" style="z-index: 99;">
                    <div class="col-lg-12 col-md-12">
                        <div class="shorting-menu">
                            <button class="filter" data-filter="all">All</button>
                            <?php foreach ($categorias as $key => $cat) { ?>
                                <button class="filter" data-filter=".category-<?= $cat->id ?>"><?= $cat->nombre ?></button>
                            <?php }; ?>
                        </div>
                    </div>
                </div>

                <div class="shorting">
                    <div class="row">
                        <?php foreach ($proyectos as $key => $proy) { ?>
                            <div class="col-lg-4 col-md-6 mix category-<?= $proy->cat_id ?>">
                                <div class="single-portfolio">
                                    <img src="<?= $proy->img ?>" alt="portfolio">
                                    <div class="content">
                                        <h3><?= $proy->nombre ?></h3>
                                        <a href="<?= $proy->img ?>" class="zoom-portfolio"><i class="fa fa-search-plus"></i></a>
                                        <a href="<?= $proy->url ?>" target="_blank" class="link-btn"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php }; ?>

                    </div>
                </div>
            </div>
        </section>
        <!-- End Portfolio Area -->

        <!-- Start Modal Area -->
        <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="portfolio-details-content">
                            <img src="web/img/portfolio-1.jpg" alt="portfolio">
                            <div class="portfolio-details-text">
                                <h4>Web Design</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                                <br>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Area -->