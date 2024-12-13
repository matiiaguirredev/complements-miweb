        <!-- Start Testimonials Area -->
        <section id="testimonials" class="testimonials-area ptb-80">
            <div class="container">
                <div class="section-title">
                    <h2><?= $sub_titulo; ?></h2>
                    <h3><?= $titulos; ?>.</h3>
                    <p><?= $descripciones; ?></p>
                </div>
                <div class="row">
                    <div class="testimonial-slider owl-carousel owl-theme">
                        <?php foreach ($testimonios as $key => $tes) { ?>
                            <div class="col-lg-12 col-md-12">
                                <div class="testimonial-item single-testimonial">
                                    <?php /* debug($testimonios,false); */ ?>
                                    <div class="client-img client-img-<?= $key ;?>">
                                        <style>
                                            .client-img-<?= $key ;?>{
                                                background-image: url(<?= $tes->img; ?>);
                                            }
                                        </style>
                                        <img class="opacity-0" src="./api/bgimg/85/85" alt="client">
                                    </div>

                                    <div class="testimonial-info">
                                        <h4><?= $tes->nombre; ?></h4>
                                        <span><?= $tes->rama_laboral; ?></span>
                                    </div>

                                    <p><?= $tes->descrip_exp; ?></p>
                                </div>

                            </div>
                        <?php }; ?>

                        <!-- <div class="col-lg-12 col-md-12">
                            <div class="testimonial-item single-testimonial">
                                <div class="client-img">
                                    <img src="web/img/client-avatar2.jpg" alt="client">
                                </div>
                                
                                <div class="testimonial-info">
                                    <h4>Steven Smith</h4>
                                    <span>Web Developer</span>
                                </div>
                                
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="testimonial-item single-testimonial">
                                <div class="client-img">
                                    <img src="web/img/client-avatar3.jpg" alt="client">
                                </div>
                                
                                <div class="testimonial-info">
                                    <h4>David Warner</h4>
                                    <span>Web Developer</span>
                                </div>
                                
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="testimonial-item single-testimonial">
                                <div class="client-img">
                                    <img src="web/img/client-avatar1.jpg" alt="client">
                                </div>
                                
                                <div class="testimonial-info">
                                    <h4>James Anderson</h4>
                                    <span>Web Developer</span>
                                </div>
                                
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12">
                            <div class="testimonial-item single-testimonial">
                                <div class="client-img">
                                    <img src="web/img/client-avatar2.jpg" alt="client">
                                </div>
                                
                                <div class="testimonial-info">
                                    <h4>Mark Wood</h4>
                                    <span>Web Developer</span>
                                </div>
                                
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End Testimonials Area -->