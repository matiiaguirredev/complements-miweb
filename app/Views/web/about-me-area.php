        <!-- Start About Area -->
        <section id="about" class="about-area ptb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-7">
                        <div class="about-text">
                            <h3>Acerca de mi.</h3>
                            <p><?= $perfil->descripcion ?></p>
                            <ul>
                                <li><span>Name : </span><?= $perfil->nombre ?> <?= $perfil->apellido ?></li>
                                <li><span>Age : </span><?= $perfil->edad ?></li>
                                <li><span>Phone : </span><?= $perfil->tel ?></li>
                                <li><span>Email : </span><?= $perfil->email ?></li>
                            </ul>
                            <a href="#" class="btn btn-primary me-3">Download CV <i class="fa fa-download"></i></a>
                            <a href="#contact" class="btn btn-primary"><?= $titulos ?> <i class="fa fa-phone"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 row">
                        <div class="col-6">
                            <div class="about-skill">
                                <?php foreach ($lenguajesDiv[0] as $key => $lenguaje) : ?>
                                    <h3 class="progress-title"><?= $lenguaje->nombre ?></h3>
                                    <div class="progress">
                                        <div class="progress-bar" style="width:<?= $lenguaje->porcentaje ?>% ;">
                                            <div class="progress-value"><?= $lenguaje->porcentaje ?>%</div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="about-skill">
                                <?php foreach ($lenguajesDiv[1] as $key => $lenguaje) : ?>
                                    <h3 class="progress-title"><?= $lenguaje->nombre ?></h3>
                                    <div class="progress">
                                        <div class="progress-bar" style="width:<?= $lenguaje->porcentaje ?>% ;">
                                            <div class="progress-value"><?= $lenguaje->porcentaje ?>%</div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <?php if (count($hobies) > 0) { ?>
                        <div class="col-lg-12 col-md-12 prueba">
                            <div class="hobbies-interest">

                                <h3 class="title"><?= $titulos ?></h3>
                                <div class="row">
                                    <?php foreach ($hobies as $key => $hobie) { ?>
                                        <div class="col-lg-3 col-md-4">
                                            <div class="box">
                                                <h3><?= $hobie->titulo; ?></h3>
                                                <h3><?= $hobie->descripcion; ?></h3> <!-- NO LA LLAMAMOS POR QUE NO LA QUEREMOS AL MOMENTO -->
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- End About Area -->