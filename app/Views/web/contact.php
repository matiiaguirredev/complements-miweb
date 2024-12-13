        <!-- Start Contact Area -->
        <section id="contact" class="contact-area ptb-80">
            <div class="container">
                <div class="section-title">
                    <h2><?= $titulos ?></h2>
                    <h3><?= $titulos ?></h3> <!-- se repire uno de los titulos por que es el que esta de fondo -->
                    <p><?= $descripciones ?></p>
                </div>
                <div class="row">
                    <?php foreach ($contacto as $key => $cont) {; ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-info">
                                <?= $cont->iconHTML ?>
                                <p><?= $cont->info ?>, <br> <?= $cont->info_secundaria ?></p>
                            </div>
                        </div>
                    <?php }; ?>

                    <!-- <div class="col-lg-4 col-md-6">
                        <div class="contact-info">
                            <i class="fa fa-map-marker"></i>
                            <p>350 5th Ave, New York, <br> NY 10118, USA</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-info">
                            <i class="fa fa-phone"></i>
                            <p>+123 1735 2156</p>
                            <p>+321 2156 1735</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-info mb-0">
                            <i class="fa fa-phone"></i>
                            <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="167f7870795672737b793875797b">[email&#160;protected]</a></p>
                            <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c3a2afa6bbedb0aeaab7ab83a4aea2aaafeda0acae">[email&#160;protected]</a></p>
                        </div>
                    </div> -->
                </div>

                <div class="row pt-5">
                    <div class="col-lg-4 col-md-4">
                        <div class="lets-connect">
                            <h3 class="title">Let’s Connect</h3>
                            <ul>
                                <?php foreach ($redes as $key => $red) : ?>
                                    <li><a href="<?= $red->url ?>" target="_blank"><?= $red->iconHTML ?><?= $red->nombre ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8">
                        <h3 class="title">Send Me a Message</h3>
                        <!-- <form action="./api/mailing" method="POST" id="contactForm2"> -->
                        <form action="" method="POST" id="contactForm2">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required data-error="Please enter your subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="6" placeholder="Message" required data-error="Write your message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <!-- <button type="submit" class="btn btn-primary">Send Message <i class="fa fa-angle-double-right"></i></button> -->
                                    <!-- <button class="g-recaptcha btn btn-primary" data-sitekey="6LdOYR4qAAAAAGsNCUjLk7RrXUNWevtcCXrOa1Tv" data-callback='onSubmit' data-action='submit'>Enviar mensaje <i class="fa fa-angle-double-right"></i></button> -->
                                    
                                    <!-- clave de prueba de captcha -->
                                    <button class="g-recaptcha btn btn-primary" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback='onSubmit' data-action='submit'>Enviar mensaje <i class="fa fa-angle-double-right"></i></button> 
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row pt-5">
                    <div class="col-lg-12 col-md-12">
                        <!-- Start Map Area -->
                        <div id="map">
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.6263059070925!2d-73.98729598434377!3d40.748247643333585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b30eac9f%3A0xaca05ca48ab5ac2c!2s350%205th%20Ave%2C%20New%20York%2C%20NY%2010118%2C%20USA!5e0!3m2!1sen!2sbd!4v1621506059842!5m2!1sen!2sbd"></iframe> -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d194348.35085516592!2d-3.9913773259058463!3d40.43779675125324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid%2C%20Spain!5e0!3m2!1sen!2sbd!4v1711168469679!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <!-- End Map Area -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->