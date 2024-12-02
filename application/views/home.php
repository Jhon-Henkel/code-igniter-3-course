        <!-- Header -->
        <header>
            <div class="container">
                <div class="slider-container">
                    <div class="intro-text">
                        <div class="intro-lead-in">Aprenda com profissionais qualificados!</div>
                        <div class="intro-heading">Alfahelix treinamentos</div>
                        <a href="<?= base_url(); ?>#about" class="page-scroll btn btn-xl">Conheça nossos cursos</a>
                    </div>
                </div>
            </div>
        </header>
        <section id="about" class="light-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Sobre</h2>
                            <p>Promovemos cursos de alta qualidade com profissionais graduados, com mestrado e doutorado.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </section>
        <section class="overlay-dark bg-img1 dark-bg short-section">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-offset-3 col-md-3 mb-sm-30">
                        <div class="counter-item">
                            <a class="page-scroll" href="<?= base_url(); ?>#portfolio">
                                <h6>Cursos</h6>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 mb-sm-30">
                        <div class="counter-item">
                            <a class="page-scroll" href="<?= base_url(); ?>#team">
                                <h6>Equipe</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="portfolio" class="light-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Cursos</h2>
                            <p>Conheça nossa lista de cursos.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if (! empty($courses)) {
                        foreach ($courses as $course) { ?>
                            <div class="col-md-4">
                                <div class="ot-portfolio-item">
                                    <figure class="effect-bubba">
                                        <img src="<?= base_url($course['course_img']); ?>" alt="img02" class="img-responsive center-block" />
                                        <figcaption>
                                            <a href="#" data-toggle="modal" data-target="#course_<?= $course['course_id'] ?>"></a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="modal fade" id="course_<?= $course['course_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="Modal-label-1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="Modal-label-1"><?= $course['course_name'] ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= base_url($course['course_img']); ?>" alt="img01" class="img-responsive center-block" />
                                            <div class="modal-works"><span><?= intval($course['course_duration']) ?> (h)</span></div>
                                            <p><?= $course['course_description'] ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div><!-- end container -->
        </section>
        <section id="team" class="light-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Equipe</h2>
                            <p>Conheça nossa equipe</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- team member item -->
                    <div class="col-md-3">
                        <div class="team-item">
                            <div class="team-image">
                                <img src="<?= base_url(); ?>public/images/demo/author-2.jpg" class="img-responsive" alt="author">
                            </div>
                            <div class="team-text">
                                <h3>TOM BEKERS</h3>
                                <div class="team-location">Sydney, Australia</div>
                                <div class="team-position">– CEO & Web Design –</div>
                                <p>Mida sit una namet, cons uectetur adipiscing adon elit. Aliquam vitae barasa droma.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end team member item -->
                </div>
            </div>
        </section>
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>CONTATO</h2>
                            <p>Entre em contato conosco por aqui<br>Tentaremos responder o mais rápido possível</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <form name="sentMessage" id="contactForm" novalidate="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Seu nome *" id="name" required="" data-validation-required-message="Please enter your name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Seu e-mail *" id="email" required="" data-validation-required-message="Please enter your email address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Sua mensagem *" id="message" required="" data-validation-required-message="Please enter a message."></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" class="btn">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <p id="back-top">
            <a href="#top"><i class="fa fa-angle-up"></i></a>
        </p>