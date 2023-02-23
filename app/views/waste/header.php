<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/font-awesome/css/font-awesome.min.css">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title><?=WEBSITE_TITLE?></title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?=ASSETS . THEME?>/assets/img/favicons_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=ASSETS . THEME?>/assets/img/favicons_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=ASSETS . THEME?>/assets/img/favicons_io/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?=ASSETS . THEME?>/assets/img/favicons_io/favicon.ico">
    <link rel="manifest" href="<?=ASSETS . THEME?>/assets/img/favicons_io//site.webmanifest">
    <meta name="msapplication-TileImage" content="<?=ASSETS . THEME?>/assets/img/favicons_io/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="<?=ASSETS . THEME?>/assets/css/theme.css" rel="stylesheet" />

  </head>
<?php
   $image = 'uploads/user.jpg';
   if(isset($user_data)){
     if (file_exists($user_data->image)) //looking for if exist some file int the collumn image
     {
        $image = $user_data->image;
     }
   }
?>

  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container-fluid"><a class="navbar-brand" href="#"><img src="<?=ASSETS . THEME?>/assets/logo/logo.jpg" alt="" width="50" height="50"/></a>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ms-lg-4 ms-xl-7 border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
              <li class="nav-item"><a class="nav-link fw-medium active" aria-current="page" href="#"><u>Pagina Incial</u></a></li>
              <li class="nav-item"><a class="nav-link fw-medium" href="#"><u>Acessar Mapa</u></a></li>
            </ul>
            <?php if(isset($data['user_data'])):?>
                 <a href=""><img src="<?= ($data['user_data']->image != "") ? ROOT.$data['user_data']->image : ROOT.$image?>" width="24" style="border-radius: 50%;"> <?= $data['user_data']->name ?></a>
            <?php endif; ?>
            <form class="d-flex py-3 py-lg-0">

               <?php if(isset($data['user_data'])):?>
                  <a class="btn btn-link text-1000 fw-medium order-1 order-lg-0 me-lg-2" href="<?=ROOT?>logout" role="button">LogOut <i class="fa fa-sign-out"></i></a>
               <?php else: ?>
              <a class="btn btn-link text-1000 fw-medium order-1 order-lg-0 me-lg-2" href="<?=ROOT?>login" role="button">LogIn</a><?php endif; ?><?php if((isset($data['user_data']) && $data['user_data']->rank == "Administrador") || isset($data['user_data']) && $data['user_data']->rank == "Supervisor"):?><a class="btn btn-info order-0 me-1" href="<?=ROOT?>admin" role="button">Entrar</a>
              

              <div class="d-flex align-items-center ps-lg-3 order-3">
                <!--<svg class="bi bi-search" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#272D4E" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg>-->
              </div>
              <?php endif;?>
            </form>
          </div>
        </div>
      </nav>


