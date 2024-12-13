        <!-- Start Fun Facts Area -->
        <section class="fun-facts ptb-80">
            <style>
                .fun-facts {
                    background-image: url(<?= $img ?>);

                }
            </style>
            <div class="container">
                <div class="row">
                    <?php foreach ($clientes as $key => $cli) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="funFact">
                                <h2><span class="counter"><?= $cli->cant ?></span>+</h2>
                                <p><?= $cli->titulo ?></p>
                            </div>
                        </div>
                    <?php  }; ?>

<?php /* esto es lo original que traia, aun no borrar ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="funFact">
                            <h2><span class="counter">200</span>+</h2>
                            <p>Happy Clients</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="funFact">
                            <h2><span class="counter">1240</span>+</h2>
                            <p>Lines Of Code</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="funFact">
                            <h2><span class="counter">58</span>+</h2>
                            <p>Awards Achieved</p>
                        </div>
                    </div>
<?php */?>

                </div>
            </div>
        </section>
        <!-- End Fun Facts Area -->