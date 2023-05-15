<?php $this->view("header", $data);?>
<?php
    if(isset($user_data)){
        $image = 'uploads/user.jpg';
        if (file_exists($user_data->image)) //looking for if exist some file int the collumn image
        {
            $image = $user_data->image;
        }
    }
?>

            <!-- header end-->
            <!-- wrapper-->
            <div id="wrapper">
                <!-- content-->
                <div class="content">
                    <!--section  -->
                    <section class="hero-section" data-scrollax-parent="true">
                        <div class="bg-tabs-wrap">
                            <div class="bg-parallax-wrap" data-scrollax="properties: { translateY: '200px' }">
                                <div class="video-container">
                                    <video autoplay playsinline loop muted class="bgvid">
                                        <source src="<?=ASSETS.THEME?>video/2.mp4" type="video/mp4">
                                    </video>
                                </div>
                                <!--  
                                    Vimeo code
                                    
                                     <div  class="background-vimeo" data-vim="97871257"> </div> -->
                                <!--  
                                    Youtube code 
                                    
                                     <div  class="background-youtube-wrapper" data-vid="Hg5iNVSp2z8" data-mv="1"> </div> -->
                                <div class="overlay op7"></div>
                            </div>
                        </div>
                        <div class="container small-container">
                            <div class="intro-item fl-wrap">
                                <span class="section-separator"></span>
                                <div class="bubbles">
                                    <h1>Gerir + Localizar + Monitorar</h1>
                                </div>
                                <h3>Desenvolver um sistema de geolocalização para garantir que o gerenciamento dos resíduos seja feito de forma mais eficiente, otimizando rotas de coleta e facilitando a localização de pontos de descarte adequados.</h3>
                            </div>
                            <!-- main-search-input-tabs-->
                            
                            <div class="hero-categories fl-wrap">
                                <h4 class="hero-categories_title">Simples e Pratico. Faz um Pedido :</h4>
                                <ul class="no-list-style">
                                    <li>
                                        <a href="listing.html">
                                            <i class="far fa-recycle"></i>
                                            <span>Preservar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="listing.html">
                                            <i class="far fa-trash"></i>
                                            <span>Gerir</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="listing.html">
                                            <i class="far fa-wifi"></i>
                                            <span>Monitorar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="listing.html">
                                            <i class="far fa-spinner"></i>
                                            <span>Localizar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="listing.html">
                                            <i class="far fa-clock"></i>
                                            <span>Colectar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-sec-link">
                            <a href="#sec1" class="custom-scroll-link">
                                <i class="fal fa-angle-double-down"></i>
                            </a>
                        </div>
                    </section>
                    <!--section end-->
                    <!--section  -->
                    <section class="slw-sec" id="sec1">
                        <div class="section-title">
                            <h2>Monitoramento Baseado em IOT</h2>
                            <div class="section-subtitle">IOT + AI</div>
                            <span class="section-separator"></span>
                            <p>Construindo um Mundo Verde e Saudável.</p>
                        </div>
                        <div class="listing-slider-wrap fl-wrap">
                            <div class="listing-slider fl-wrap">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <!--  swiper-slide  -->
                                        <div class="swiper-slide">
                                            <div class="listing-slider-item fl-wrap">
                                                <!-- listing-item  -->
                                                <div class="listing-item listing_carditem">
                                                    <article class="geodir-category-listing fl-wrap">
                                                        <div class="geodir-category-img">
                                                            
                                                            <a  class="geodir-category-img-wrap fl-wrap">
                                                                <img src="<?=ASSETS.THEME?>images/lixos/16.jpg" alt="">
                                                            </a>
                                                            
                                                        </div>
                                                    </article>
                                                </div>
                                                <!-- listing-item end -->
                                            </div>
                                        </div>
                                        <!--  swiper-slide end  -->
                                        <!--  swiper-slide  -->
                                        <div class="swiper-slide">
                                            <div class="listing-slider-item fl-wrap">
                                                <!-- listing-item  -->
                                                <div class="listing-item listing_carditem">
                                                    <article class="geodir-category-listing fl-wrap">
                                                        <div class="geodir-category-img">
                                                            
                                                            <a  class="geodir-category-img-wrap fl-wrap">
                                                                <img src="<?=ASSETS.THEME?>images/lixos/14.jpeg" alt="">
                                                            </a>
                                                            
                                                        </div>
                                                    </article>
                                                </div>
                                                <!-- listing-item end -->
                                            </div>
                                        </div>
                                        <!--  swiper-slide  -->
                                        <div class="swiper-slide">
                                            <div class="listing-slider-item fl-wrap">
                                                <!-- listing-item  -->
                                                <div class="listing-item listing_carditem">
                                                    <article class="geodir-category-listing fl-wrap">
                                                        <div class="geodir-category-img">
                                                            
                                                            <a  class="geodir-category-img-wrap fl-wrap">
                                                                <img src="<?=ASSETS.THEME?>images/lixos/18.jpg" alt="">
                                                            </a>
                                                            
                                                        </div>
                                                    </article>
                                                </div>
                                                <!-- listing-item end -->
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="listing-slider-item fl-wrap">
                                                <!-- listing-item  -->
                                                <div class="listing-item listing_carditem">
                                                    <article class="geodir-category-listing fl-wrap">
                                                        <div class="geodir-category-img">
                                                            
                                                            <a  class="geodir-category-img-wrap fl-wrap">
                                                                <img src="<?=ASSETS.THEME?>images/lixos/15.jpg" alt="">
                                                            </a>
                                                            
                                                        </div>
                                                    </article>
                                                </div>
                                                <!-- listing-item end -->
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="listing-carousel-button listing-carousel-button-next2">
                                    <i class="fas fa-caret-right"></i>
                                </div>
                                <div class="listing-carousel-button listing-carousel-button-prev2">
                                    <i class="fas fa-caret-left"></i>
                                </div>
                            </div>
                            <div class="tc-pagination_wrap">
                                <div class="tc-pagination2"></div>
                            </div>
                        </div>
                    </section>
                    <!--section end-->
                    <div class="sec-circle fl-wrap"></div>
                    <!--section -->
                    <section class="parallax-section small-par" data-scrollax-parent="true">
                        <div class="bg par-elem " data-bg="<?=ASSETS.THEME?>images/lixos/18.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
                        <div class="overlay  op7"></div>
                        <div class="container">
                            <div class=" single-facts single-facts_2 fl-wrap">
                                <!-- inline-facts -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="<?=is_array($users)?count($users):'0'?>"><?=is_array($users)?count($users):'0'?></div>
                                            </div>
                                        </div>
                                        <h6>Usuários</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="<?=is_array($messages)?count($messages):'0'?>"><?=is_array($messages)?count($messages):'0'?></div>
                                            </div>
                                        </div>
                                        <h6>Mensagens</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="<?=is_array($colector_group)?count($colector_group):'0'?>"><?=is_array($colector_group)?count($colector_group):'0'?></div>
                                            </div>
                                        </div>
                                        <h6>Grupos de Colecta</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="<?=is_array($contentores)?count($contentores):'0'?>"><?=is_array($contentores)?count($contentores):'0'?></div>
                                            </div>
                                        </div>
                                        <h6>Contentores</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                            </div>
                        </div>
                    </section>
                    <!--section end-->
                    <!--section  -->
                    
                    <!--section  -->
                    <section data-scrollax-parent="true">
                        <div class="container">
                            <div class="section-title">
                                <h2>Como Funciona</h2>
                                <div class="section-subtitle">Solução &amp;Inteligente </div>
                                <span class="section-separator"></span>
                                <p>Caso tenha um montante de lixo, não êxite em nos mandar uma mensagem.</p>
                            </div>
                            <div class="process-wrap fl-wrap">
                                <ul class="no-list-style">
                                    <li>
                                        <div class="process-item">
                                            <span class="process-count">01 </span>
                                            <div class="time-line-icon">
                                                <i class="fal fa-map-marker-alt"></i>
                                            </div>
                                            <h4>Geolocalização</h4>
                                            <p>Geolocalização de Residuos Solidos.</p>
                                        </div>
                                        <span class="pr-dec"></span>
                                    </li>
                                    <li>
                                        <div class="process-item">
                                            <span class="process-count">02</span>
                                            <div class="time-line-icon">
                                                <i class="fal fa-layer-plus"></i>
                                            </div>
                                            <h4>Monitoramento</h4>
                                            <p>Monitoramento de Residuos de Solidos.</p>
                                        </div>
                                        <span class="pr-dec"></span>
                                    </li>
                                    <li>
                                        <div class="process-item">
                                            <span class="process-count">03</span>
                                            <div class="time-line-icon">
                                                <i class="fal fa-mail-bulk"></i>
                                            </div>
                                            <h4>Gestão</h4>
                                            <p>Gerir solicitações de mensagens.</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="process-end">
                                    <i class="fal fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--section end-->
                    <!--section  -->
                    <section class="gradient-bg hidden-section" data-scrollax-parent="true">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="colomn-text  pad-top-column-text fl-wrap">
                                        <div class="colomn-text-title">
                                            <h3>Sistema Totalmente Responsível</h3>
                                            <p>SmartWaste, Sistema de Gestão, Geolocalização e Monitoramento de Resíduos Sólidos</p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="collage-image">
                                        <img src="<?=ASSETS.THEME?>images/api.png" class="main-collage-image" alt="">
                                        <div class="images-collage-title color2-bg icdec">
                                            SmartWaste
                                        </div>
                                        <div class="images-collage_icon green-bg" style="right:-20px; top:120px;">
                                            <i class="fal fa-thumbs-up"></i>
                                        </div>
                                        <div class="collage-image-min cim_1">
                                            <img src="<?=ASSETS.THEME?>images/api/1.jpg" alt="">
                                        </div>
                                        <div class="collage-image-min cim_2">
                                            <img src="<?=ASSETS.THEME?>images/api/2.jpg" alt="">
                                        </div>
                                        <div class="collage-image-btn green-bg">Booking now</div>
                                        <div class="collage-image-input">
                                            Search <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gradient-bg-figure" style="right:-30px;top:10px;"></div>
                        <div class="gradient-bg-figure" style="left:-20px;bottom:30px;"></div>
                        <div class="circle-wrap" style="left:270px;top:120px;" data-scrollax="properties: { translateY: '-200px' }">
                            <div class="circle_bg-bal circle_bg-bal_small"></div>
                        </div>
                        <div class="circle-wrap" style="right:420px;bottom:-70px;" data-scrollax="properties: { translateY: '150px' }">
                            <div class="circle_bg-bal circle_bg-bal_big"></div>
                        </div>
                        <div class="circle-wrap" style="left:420px;top:-70px;" data-scrollax="properties: { translateY: '100px' }">
                            <div class="circle_bg-bal circle_bg-bal_big"></div>
                        </div>
                        <div class="circle-wrap" style="left:40%;bottom:-70px;">
                            <div class="circle_bg-bal circle_bg-bal_middle"></div>
                        </div>
                        <div class="circle-wrap" style="right:40%;top:-10px;">
                            <div class="circle_bg-bal circle_bg-bal_versmall" data-scrollax="properties: { translateY: '-350px' }"></div>
                        </div>
                        <div class="circle-wrap" style="right:55%;top:90px;">
                            <div class="circle_bg-bal circle_bg-bal_versmall" data-scrollax="properties: { translateY: '-350px' }"></div>
                        </div>
                    </section>
                    <!--section end-->
                    <!--section  -->
                    <section>
                        <div class="container">
                            <div class="section-title">
                                <h2>Mensagens</h2>
                                <div class="section-subtitle">Mensagens de Colecta</div>
                                <span class="section-separator"></span>
                                <p>Últimas mensagens enviadas pelos últimos usuários.</p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="testimonilas-carousel-wrap fl-wrap">
                            <div class="listing-carousel-button listing-carousel-button-next">
                                <i class="fas fa-caret-right"></i>
                            </div>
                            <div class="listing-carousel-button listing-carousel-button-prev">
                                <i class="fas fa-caret-left"></i>
                            </div>
                            <div class="testimonilas-carousel">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <!--testi-item-->
                                        <?php if(is_array($messages)):?>
                                            <?php foreach($messages as $message):?>
                                                <?php
                                                    $DB = Database::newInstance();
                                                    $id = $message->user_id;
                                                    $user_info = $DB->read("select * from users where id = '$id'");
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="testi-item fl-wrap">
                                                        <div class="testi-avatar">
                                                            <img src="<?=ROOT?><?=$user_info[0]->image!=''?$user_info[0]->image:$image?>" alt="">
                                                        </div>
                                                        <div class="testimonilas-text fl-wrap">
                                                            <p>"<?=$message->message?> "</p>
                                                            <div class="testimonilas-avatar fl-wrap">
                                                                <h3><?=$user_info[0]->name?></h3>
                                                                <h4><?=$user_info[0]->rank?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                        <!--testi-item end-->
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="tc-pagination"></div>
                        </div>
                        <div class="waveWrapper waveAnimation">
                            <div class="waveWrapperInner bgMiddle">
                                <div class="wave-bg-anim waveMiddle" style="background-image: url('<?=ASSETS.THEME?>images/wave-top.png')"></div>
                            </div>
                            <div class="waveWrapperInner bgBottom">
                                <div class="wave-bg-anim waveBottom" style="background-image: url('<?=ASSETS.THEME?>images/wave-top.png')"></div>
                            </div>
                        </div>
                    </section>
                    <!--section end-->
                    <!--section  -->
<?php $this->view("footer", $data);?>