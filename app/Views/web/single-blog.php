<?php /* debug($this->data['user']) ; */ ?>


<!-- Start Page Title Area -->
<div class="page-title">
    <div id="particles-js"></div>

    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h3>Single Blog</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>/</li>
                            <li>Blog Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Blog- Details Area -->
<section class="blog-details-area ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog-details">
                    <div class="thumb thumb-imgpost">
                        <style>
                            .thumb-imgpost {
                                background-image: url(<?= $blog->img_post; ?>);
                            }
                        </style>
                        <img class="opacity-0" src="./api/bgimg/1250/700" alt="blog-details">

                        <div class="date">
                            <span><?= dia_mes($blog->create_at); ?></span>
                        </div>
                    </div>

                    <div class="blog-details-heading">
                        <!-- <h3>The best tips of web design</h3> -->
                        <h3><?= $blog->titulo ?></h3>

                        <ul>
                            <?php if (isset($user) && isset($user->informacion)) { ?>
                                <li>Posted By: <a href="#"><?= $user->informacion->nombre . ' ' . $user->informacion->apellido; ?></a></li>
                            <?php } else { ?>
                                <li>Posted By: Natalia Perez</li>
                            <?php } ?>

                            <li><a href="#"><i class="fa fa-comments-o"></i> 05</a></li>
                            <li><a href="#"><i class="fa fa-thumbs-up"></i> 15</a></li>
                        </ul>
                    </div>

                    <div class="blog-details-content">
                        <?php /* $blog->contenido */; ?>
                        <!-- <div class="ql-editor"><p class="ql-align-center"></p></div> -->

                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>

                        <blockquote class="blockquote">
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                            <footer class="blockquote-footer"><cite title="Source Title">John Smith</cite></footer>
                        </blockquote>

                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>

                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                        <p class="mb-0">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p> -->

                        <div class="blog-details-meta">
                            <div class="tags">
                                <ul>
                                    <li class="title">Tags:</li>
                                    <?php
                                    // Primero, imprimimos la categoría actual si existe.
                                    $blogCategoriaActual = null;

                                    foreach ($blogCat as $bC) {
                                        if ($blog->categoria == $bC->nombre) {
                                            $blogCategoriaActual = $bC;
                                            break;
                                        }
                                    }

                                    if ($blogCategoriaActual) {
                                        // Imprimir la categoría actual primero
                                        echo '<li class="px-1"><a href="#">' . $blogCategoriaActual->nombre . '</a></li>';
                                    }

                                    // Luego, imprimimos las demás categorías
                                    foreach ($blogCat as $bC) {
                                        if ($blogCategoriaActual && $bC->nombre == $blogCategoriaActual->nombre) {
                                            // Saltamos la categoría actual ya que ya se ha impreso
                                            continue;
                                        }
                                        echo '<li class="px-1"><a href="#">' . $bC->nombre . '</a></li>';
                                    }
                                    ?>

                                    <?php
                                    /* foreach ($blogCat as $key => $bC) { ?>
                                        <?php if ($blog->categoria == $blogCat->nombre) { ?>

                                            <li><a href="#"><?= $bC->nombre ?></a></li>
                                        <?php } ?>
                                    <?php } */
                                    ?>
                                    <!-- <li><a href="#">Design</a></li>
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Graphic</a></li> -->
                                </ul>
                            </div>

                            <div class="share">
                                <ul>
                                    <li class="title">Compartir:</li>
                                    <?php foreach ($redes as $key => $r) { ?>
                                        <li><a href="<?= $r->url ?>"><i class=""><?= $r->iconHTML ?></i></a></li>
                                    <?php } ?>
                                    <!-- 
                                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li> 
                                    -->
                                </ul>
                            </div>
                        </div>

                        <div class="blog-details-comments">
                            <!-- <h3 class="title">Comentarios (03)</h3> -->
                            <?php /* ESTE ES MI CODIGO QUE FUNCIONA MAL PERO FUNCION
                            numComm = count($blogComm2); ?>
                            <h3 class="title">Comentarios <?php echo "($numComm)" ?></h3>
                            <?php if (isset($blogComm2) && is_array($blogComm2)) { ?>
                                <?php foreach ($blogComm2 as $key => $bc2) { ?>
                                    <div class="single-comments">
                                        <div class="thumb thumb-imgsingleblog">
                                            <?php if (isset($user) && isset($user->informacion)) { ?>
                                                <style>
                                                    .thumb-imgsingleblog {
                                                        background-image: url(<?= $user->informacion->img ?>);
                                                        background-position: center;
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                        border-radius: 50%;
                                                    }
                                                </style>
                                                <img class="opacity-0 thumb-imgsingleblog" src="./api/bgimg/85/85" alt="client">
                                            <?php } else { ?>
                                                <img class="thumb-imgsingleblog" src="./api/bgimg/85/85" alt="client">
                                            <?php }; ?>
                                        </div>

                                        <div class="content">
                                            <h4><?= $bc2->name; ?></h4>
                                            <span><?= dia_mes_ano($blog->create_at); ?></span>
                                            <p><?= $bc2->message; ?></p>
                                            <a href="#">Reply <i class="fa fa-reply"></i></a>
                                        </div>
                                    </div>
                                    <div class="border"></div>
                                <?php } ?>
                            <?php } */ ?>

                            <?php if (empty($numComm)) { ?>
                                <p>No hay comentarios para este post.</p>
                            <?php } else { ?>
                                <h3 class="title">Comentarios <?php echo "($numComm)" ?></h3>
                                <?php if (isset($this->data['blogComm2']) && is_array($this->data['blogComm2'])) { ?>
                                    <?php foreach ($this->data['blogComm2'] as $key => $bc2) { ?>
                                        <div class="single-comments">
                                            <div class="thumb thumb-imgsingleblog">
                                                <?php if (isset($user) && isset($user->informacion)) { ?>
                                                    <style>
                                                        .thumb-imgsingleblog {
                                                            background-image: url(<?= $user->informacion->img ?>);
                                                            background-position: center;
                                                            background-repeat: no-repeat;
                                                            background-size: cover;
                                                            border-radius: 50%;
                                                        }
                                                    </style>
                                                    <img class="opacity-0 thumb-imgsingleblog" src="./api/bgimg/85/85" alt="client">
                                                <?php } else { ?>
                                                    <img class="thumb-imgsingleblog" src="./api/bgimg/85/85" alt="client">
                                                <?php } ?>
                                            </div>

                                            <div class="content">
                                                <h4><?= $bc2->name ?></h4>
                                                <span><?= dia_mes_ano($blog->create_at); ?></span>
                                                <p><?= $bc2->message; ?></p>
                                                <a href="">Reply <i class="fa fa-reply"></i></a>
                                            </div>
                                        </div>
                                        <div class="border"></div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>


                            <!-- <div class="single-comments" bis_skin_checked="1">
                                <div class="thumb" bis_skin_checked="1">
                                    <img src="web/img/client-avatar1.jpg" alt="client">
                                </div>

                                <div class="content" bis_skin_checked="1">
                                    <h4>Steven Smith</h4>
                                    <span>December 30, 2024</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                    <a href="#">Reply <i class="fa fa-reply"></i></a>
                                </div>
                            </div>

                            <div class="single-comments left-mr">
                                <div class="thumb">
                                    <img src="web/img/client-avatar3.jpg" alt="client">
                                </div>

                                <div class="content">
                                    <h4>Eva Smith</h4>
                                    <span>December 30, 2024</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                    <a href="#">Reply <i class="fa fa-reply"></i></a>
                                </div>
                            </div> -->
                            <!-- 
                            <div class="border"></div>

                            <div class="single-comments">
                                <div class="thumb">
                                    <img src="web/img/client-avatar2.jpg" alt="client">
                                </div>

                                <div class="content">
                                    <h4>John Doe</h4>
                                    <span>December 30, 2024</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                    <a href="#">Reply <i class="fa fa-reply"></i></a>
                                </div>
                            </div>

                            <div class="border"></div>

                            <div class="single-comments">
                                <div class="thumb">
                                    <img src="web/img/client-avatar3.jpg" alt="client">
                                </div>

                                <div class="content">
                                    <h4>David Warner</h4>
                                    <span>December 30, 2024</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                    <a href="#">Reply <i class="fa fa-reply"></i></a>
                                </div>
                            </div> -->
                        </div>

                        <div class="blog-details-comments-form">
                            <h3 class="title">Leave a Reply</h3>

                            <form id="contactForm2" action="" method="post" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" cols="30" rows="6" class="form-control" placeholder="Message"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <!-- <button class="btn btn-primary" data-callback='onSubmit' type="submit">Submit <i class="fa fa-angle-double-right"></i></button> -->
                                        <button class="g-recaptcha btn btn-primary" data-sitekey="6LdOYR4qAAAAAGsNCUjLk7RrXUNWevtcCXrOa1Tv" data-callback='onSubmit' data-action='submit'>Enviar comentario <i class="fa fa-angle-double-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Blog- Details Area -->