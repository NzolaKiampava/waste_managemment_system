<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title><?=WEBSITE_TITLE?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="<?=ASSETS.THEME?>css/reset.css">
        <link type="text/css" rel="stylesheet" href="<?=ASSETS.THEME?>css/plugins.css">
        <link type="text/css" rel="stylesheet" href="<?=ASSETS.THEME?>css/style.css">
        <link type="text/css" rel="stylesheet" href="<?=ASSETS.THEME?>css/color.css">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="<?=ASSETS.THEME?>images/favicon.ico">
    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="loader-inner">
                <div class="loader-inner-cirle"></div>
            </div>
        </div>
        <!--loader end-->
        <!-- main start  -->
        <div id="main">
            <!--login-column  -->
            <div class="login-column">
                <div class="login-column_header">
                    <img src="<?=ASSETS.THEME?>assets/logo/logo.png" alt=""><h1><img src="<?=ASSETS.THEME?>assets/logo/logo.jpg" alt="">SmartWaste</h1>
                    <div class="clearfix"></div>
                    <h4>Bem-vindo a tela de Login para Empresa.</h4>
                </div>
                <div class="main-register-holder tabs-act">
                    <div class="main-register fl-wrap">
                        <ul class="tabs-menu fl-wrap no-list-style">
                            <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Login</a></li>
                        </ul>
                        <!--tabs -->                       
                        <div class="tabs-container">
                            <div class="tab">
                                <!--tab -->
                                <div id="tab-1" class="tab-content first-tab">
                                    <div class="custom-form">
                                        <form method="post"  name="registerform">
                                            <span style="font-size: 18px; color: red;"><?php check_error() ?></span><br>
                                            <label>NIF <span>*</span> </label>
                                            <input name="nif" maxLength="9" minLength="9" type="text"   onClick="this.select()" value="<?= isset($_POST['nif']) ? $_POST['nif'] : '';?>">
                                            <label >Password <span>*</span> </label>
                                            <input name="password" id="password" type="password"   onClick="this.select()" value="<?= isset($_POST['password']) ? $_POST['password'] : '';?>" >
                                            <button type="submit" name="login_company"  class="btn float-btn color2-bg"> Log In <i class="fas fa-caret-right"></i></button>
                                            <div class="clearfix"></div>
                                            <div class="filter-tags">
                                                <input id="check-a3" onclick="show_password()" type="checkbox">
                                                <label for="check-a3">Ver Password</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--tab end -->
                                <!--tab -->
                                <!--tab end -->
                            </div>
                            <!--tabs end -->
                        </div>
                    </div>
                </div>
            </div>
            <!--login-column end-->
            <!--login-column-bg  -->
            <div class="login-column-bg gradient-bg">
                <!--ms-container-->
                <div class="slideshow-container" data-scrollax="properties: { translateY: '300px' }" >
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!--ms_item-->
                            <div class="swiper-slide">
                                <div class="ms-item_fs fl-wrap full-height">
                                    <div class="bg" data-bg="<?=ASSETS.THEME?>images/lixos/15.jpg"></div>
                                    <div class="overlay op7"></div>
                                </div>
                            </div>
                            <!--ms_item end-->
                            <!--ms_item-->
                            <div class="swiper-slide ">
                                <div class="ms-item_fs fl-wrap full-height">
                                    <div class="bg" data-bg="<?=ASSETS.THEME?>images/lixos/16.jpg"></div>
                                    <div class="overlay op7"></div>
                                </div>
                            </div>
                            <!--ms_item end-->
                            <!--ms_item-->
                            <div class="swiper-slide">
                                <div class="ms-item_fs fl-wrap full-height">
                                    <div class="bg" data-bg="<?=ASSETS.THEME?>images/lixos/17.jpg"></div>
                                    <div class="overlay op7"></div>
                                </div>
                            </div>
                            <!--ms_item end-->
                            <!--ms_item-->
                            <div class="swiper-slide">
                                <div class="ms-item_fs fl-wrap full-height">
                                    <div class="bg" data-bg="<?=ASSETS.THEME?>images/lixos/18.jpg"></div>
                                    <div class="overlay op7"></div>
                                </div>
                            </div>
                            <!--ms_item end-->
                        </div>
                    </div>
                </div>
                <!--ms-container end-->    
                <div class="login-promo-container">
                    <div class="container">
                        <div class="video_section-title fl-wrap">
                            <h4></h4>
                            <h2>Sistema de Gestão, Geolocalização e Monitoramento de Resíduos Sólidos</h2>
                        </div>
                        <a href="https://vimeo.com/174307529" class="promo-link big_prom   image-popup"><i class="fal fa-play"></i><span>Ver Video</span></a>
                    </div>
                </div>
            </div>
            <!--login-column-bg end-->
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script src="<?=ASSETS.THEME?>js/jquery.min.js"></script>
        <script src="<?=ASSETS.THEME?>js/plugins.js"></script>
        <script src="<?=ASSETS.THEME?>js/scripts.js"></script>
    </body>
</html>
<script>
  
  function show_password()
  {
    mypass = document.getElementById('password');
    if (mypass.type == "text") 
      mypass.type = "password";
    else
      mypass.type = "text";
    
  }
</script>
<script src="<?=ASSETS.THEME?>admin/dist/js/sweetalert2.all.min.js"></script>
<?php if(isset($_SESSION['sucess_recover_password'])):?>
    <script>
      Swal.fire({
        icon: 'success',
        title: '<?=$_SESSION['sucess_recover_password']?>',
        showConfirmButton: true,
        timer: 5000
      })
    </script>
  <?php endif; unset($_SESSION['sucess_recover_password'])?>
