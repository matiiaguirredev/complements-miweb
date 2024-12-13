        <!-- Start Resume Area -->
        <section id="resume" class="resume-area ptb-80">
            <div class="container">
                <div class="section-title">
                    <!-- <h2><?= $titulos ?></h2> -->
                    <h3><?= $titulos ?></h3>
                    <p><?= $descripciones ?></p>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <h3 class="title">Education</h3>
                        <ul class="timeline">
                            <?php foreach ($curriculum as $key => $cv) { ?>
                                <?php if ($cv->categoria == "edu") { ?>
                                    <li class="event">
                                        <h3><?= $cv->titulo ?></h3>
                                        <h4><span><?= $cv->sub_titulo ?></span> (<?= $cv->rango_anos ?>)</h4>
                                        <p><?= $cv->descripcion ?></p>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <h3 class="title">Expiencia</h3>
                        <ul class="timeline">
                            <?php foreach ($curriculum as $key => $cv) { ?>
                                <?php if ($cv->categoria == "exp") { ?>
                                    <li class="event">
                                        <h3><?= $cv->titulo ?></h3>
                                        <h4><span><?= $cv->sub_titulo ?></span> (<?= $cv->rango_anos ?>)</h4>
                                        <p><?= $cv->descripcion ?></p>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Resume Area -->