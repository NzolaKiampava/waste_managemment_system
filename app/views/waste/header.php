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
        <link type="text/css" rel="stylesheet" href="<?=ASSETS.THEME?>css/dashboard-style.css">
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

        <?php
            $image = 'uploads/user.jpg';
            if(isset($user_data)){
                if (file_exists($user_data->image)) //looking for if exist some file int the collumn image
                {
                    $image = $user_data->image;
                }
            }
        ?>
        <!--loader end-->
        <!-- main start  -->
        <div id="main">
            <!-- header -->
            <header class="main-header dsh-header">
                <!-- logo-->
                <a href="<?=ROOT?>" class="logo-holder"><img src="<?=ASSETS.THEME?>assets/logo/logo.png" alt=""></a>
                <!-- logo end-->
                <!-- header-search_btn-->
                <div class="header-search_btn show-search-button"><i class="fal fa-search"></i><span>Search</span></div>
                <!-- header-search_btn end-->
                <!-- header opt -->
                <?php if((isset($data['user_data']) && $data['user_data']->rank == "Administrador") || isset($data['user_data']) && $data['user_data']->rank == "Supervisor"):?>
                    <a href="<?=ROOT?>admin" class="add-list color-bg">ADMIN PAINEL <span><i class="fal fa-layer-plus"></i></span></a>
        
                <?php endif;?>
                <!-- header opt end-->
                <?php if(isset($data['user_data'])):?>
                <div class="header-user-menu">
                    <div class="header-user-name">
                        <span><img src="<?= ($data['user_data']->image != "") ? ROOT.$data['user_data']->image : ROOT.$image?>" alt=""></span>
                        <?= $data['user_data']->name ?>
                    </div>
                    <ul>
                        <li><a href="<?=ROOT?>dashboard_user"> Dashboard</a></li>
                        <li><a href="<?=ROOT?>dashboard_userprofile"> Edit profile</a></li>
                        <li><a href="<?=ROOT?>logout">Log Out</a></li>
                    </ul>
                </div>
                <div class="show-reg-form modal-open avatar-img" data-srcav="<?=ASSETS.THEME?>images/avatar/3.jpg">
                    <i class="fal fa-layer-plus"></i>
                    Enviar Mensagem
                </div>
                <?php endif;?>
                
                <!-- nav-button-wrap-->
                <div class="nav-button-wrap color-bg">
                    <div class="nav-button">
                        <span></span><span></span><span></span>
                    </div>
                </div>
                <!-- nav-button-wrap end-->
                <!--  navigation -->
                <div class="nav-holder main-menu">
                    <nav>
                        <ul class="no-list-style">
                            <li>
                                <a href="<?=ROOT?>" class="<?= $page_title == "Home" ? 'act-link':''?>" href="#">Home </a>
                            </li>
                            <li>
                                <a href="<?=ROOT?>map" <?= $page_title == "Map" ? 'act-link':''?>>Mapa <i class="fa fa-caret-down"></i></a>
                                <!--second level -->
                                <ul>
                                    <li><a href="<?=ROOT?>colummap" <?= $page_title == "Collummap" ? 'act-link':''?>>Column map</a></li>
                                </ul>
                                <!--second level end-->
                            </li>
                            <?php if(!isset($user_data)):?>
                                <li>
                                    <a href="<?=ROOT?>register" href="#">Login <i class="fa fa-user"></i></a>
                                </li>
                            <?php endif;?>
                        </ul>
                    </nav>
                </div>
                <!-- navigation  end -->
                <!-- header-search_container -->
                <div class="header-search_container header-search vis-search">
                    <div class="container small-container">
                        <div class="header-search-input-wrap fl-wrap">
                            <!-- header-search-input -->
                            <div class="header-search-input">
                                <label><i class="fal fa-keyboard"></i></label>
                                <input type="text" placeholder="What are you looking for ?"   value=""/>
                            </div>
                            <!-- header-search-input end -->
                            <!-- header-search-input -->
                            <div class="header-search-input location autocomplete-container">
                                <label><i class="fal fa-map-marker"></i></label>
                                <input type="text" placeholder="Location..." class="autocomplete-input" id="autocompleteid2" value=""/>
                                <a href="#"><i class="fal fa-dot-circle"></i></a>
                            </div>
                            <!-- header-search-input end -->
                            <!-- header-search-input -->
                            <div class="header-search-input header-search_selectinpt ">
                                <select data-placeholder="Category" class="chosen-select no-radius" >
                                    <option>All Categories</option>
                                    <option>All Categories</option>
                                    <option>Shops</option>
                                    <option>Hotels</option>
                                    <option>Restaurants</option>
                                    <option>Fitness</option>
                                    <option>Events</option>
                                </select>
                            </div>
                            <!-- header-search-input end -->
                            <button class="header-search-button green-bg" onclick="window.location.href='listing.html'"><i class="far fa-search"></i> Search </button>
                        </div>
                        <div class="header-search_close color-bg"><i class="fal fa-long-arrow-up"></i></div>
                    </div>
                </div>
                <!-- header-search_container  end -->
                
            </header>
