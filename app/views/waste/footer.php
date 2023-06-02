<section class="gray-bg">
                        <div class="container">
                            <div class="clients-carousel-wrap fl-wrap">
                                <div class="cc-btn   cc-prev">
                                    <i class="fal fa-angle-left"></i>
                                </div>
                                <div class="cc-btn cc-next">
                                    <i class="fal fa-angle-right"></i>
                                </div>
                                <div class="clients-carousel">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <!--client-item-->
                                            <?php
                                                $DB = Database::newInstance();  
                                                $search = $DB->read("select logo from empresas");
                                            ?>
                                            <?php foreach($search as $client):?>
                                                <div class="swiper-slide">
                                                    <a href="#" class="client-item">
                                                        <img height="50" src="<?=ROOT.$client->logo?>" alt="">
                                                    </a>
                                                </div>
                                            <?php endforeach;?>
                                            
                                            <!--client-item end-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--section end-->
                </div>
                <!--content end-->
            </div>
            <!-- wrapper end-->
            <!--footer -->
<?php $this->view("inner_footer", $data);?>
