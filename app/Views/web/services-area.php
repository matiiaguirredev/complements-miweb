        <!-- Start Services Area -->
        <section id="services" class="services-area bg ptb-80">
        <style>
            
        </style>
            <div class="container">
                <div class="section-title">
                    <h3><?= $titulos ?></h3>
                    <p><?= $descripciones ?></p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="servicesBox">
                            <i class="fa fa-fire"></i>
                            <div class="content">
                                <h3>Web Design</h3>
                                <p>Lorem Ipsum is simply dummy text of the Lorem Ipsum has been the industry's standard dummy text ever. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium eaque quae ab illo inventore.</p>
                            </div>
                            <span>01</span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="servicesBox">
                            <i class="fa fa-gears"></i>
                            <div class="content">
                                <h3>Web Development</h3>
                                <p>Lorem Ipsum is simply dummy text of the Lorem Ipsum has been the industry's standard dummy text ever. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium eaque quae ab illo inventore.</p>
                            </div>
                            <span>02</span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="servicesBox">
                            <i class="fa fa-mobile"></i>
                            <div class="content">
                                <h3>Responsive Design</h3>
                                <p>Lorem Ipsum is simply dummy text of the Lorem Ipsum has been the industry's standard dummy text ever. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium eaque quae ab illo inventore.</p>
                            </div>
                            <span>03</span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="servicesBox">
                            <i class="fa fa-rocket"></i>
                            <div class="content">
                                <h3>Branding Identity</h3>
                                <p>Lorem Ipsum is simply dummy text of the Lorem Ipsum has been the industry's standard dummy text ever. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium eaque quae ab illo inventore.</p>
                            </div>
                            <span>04</span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="servicesBox">
                            <i class="fa fa-camera-retro"></i>
                            <div class="content">
                                <h3>Photography</h3>
                                <p>Lorem Ipsum is simply dummy text of the Lorem Ipsum has been the industry's standard dummy text ever. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium eaque quae ab illo inventore.</p>
                            </div>
                            <span>05</span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="servicesBox">
                            <i class="fa-solid fa-headphones fa-fw"></i>
                            <div class="content">
                                <h3>Support</h3>
                                <p>Lorem Ipsum is simply dummy text of the Lorem Ipsum has been the industry's standard dummy text ever. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium eaque quae ab illo inventore.</p>
                            </div>
                            <span>06</span>
                        </div>
                    </div>

                    <?php foreach ($servicios as $key => $servicio) { ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="servicesBox">
                                <?= $servicio->iconHTML; ?>
                                <div class="content">
                                    <h3><?= $servicio->titulo; ?></h3>
                                    <p><?= $servicio->descripcion; ?></p>
                                </div>
                                <span>
                                    <?= ($key + 1 > 9) ? $key + 1 : "0" . $key + 1 ?>
                                </span>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        <!-- End Services Area -->