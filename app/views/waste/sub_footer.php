<!--sub-footer-->
<div class="sub-footer  fl-wrap">
                    <div class="container">
                        <div class="copyright">&#169;SmartWaste 2023 . Todos os direitos Reservados.</div>
                        <div class="lang-wrap">
                            <div class="show-lang">
                                <span>
                                    <i class="fal fa-globe-europe"></i>
                                    <strong>En</strong>
                                </span>
                                <i class="fa fa-caret-down arrlan"></i>
                            </div>
                            <ul class="lang-tooltip lang-action no-list-style">
                                <li>
                                    <a href="#" class="current-lan" data-lantext="En">English</a>
                                </li>
                                <li>
                                    <a href="#" data-lantext="Fr">Franais</a>
                                </li>
                                <li>
                                    <a href="#" data-lantext="Es">Espaol</a>
                                </li>
                                <li>
                                    <a href="#" data-lantext="De">Deutsch</a>
                                </li>
                            </ul>
                        </div>
                        <div class="subfooter-nav">
                            <ul class="no-list-style">
                                <li>
                                    <a href="#">Termos de uso</a>
                                </li>
                                <li>
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#">Blog</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--sub-footer end -->
            </footer>
            <!--footer end -->
            <!--map-modal -->
            <div class="map-modal-wrap">
                <div class="map-modal-wrap-overlay"></div>
                <div class="map-modal-item">
                    <div class="map-modal-container fl-wrap">
                        <div class="map-modal fl-wrap">
                            <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                        </div>
                        <h3>
                            <span>Location for : </span>
                            <a href="#">Listing Title</a>
                        </h3>
                        <div class="map-modal-close">
                            <i class="fal fa-times"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--map-modal end -->
            <!--register form -->
            <div class="main-register-wrap modal">
                <div class="reg-overlay"></div>
                <div class="main-register-holder tabs-act">
                    <div class="main-register fl-wrap  modal_main">
                        <div class="main-register_title">
                            BEMVINDO ao 
                            <span>
                                <strong>Smart</strong>
                                Waste<strong>.</strong>
                            </span>
                        </div>
                        <div class="close-reg">
                            <i class="fal fa-times"></i>
                        </div>
                        <ul class="tabs-menu fl-wrap no-list-style">
                            <li class="current">
                                <a href="#tab-1">
                                    <i class="fal fa-sign-in-alt"></i>
                                    Enviar Mensagem
                                </a>
                            </li>
                        </ul>
                        <!--tabs -->
                        <div class="tabs-container">
                            <div class="tab">
                                <!--tab -->
                                <div>
                                    <div class="custom-form">
                                        <form method="post" enctype="multipart/form-data">
                                            <select name="province" oninput="get_municipies(this.value)" class="js-country nice-select" >
                                                <?php if($province == ""){
                                                        echo "<option>-- Province --</option>";
                                                    }else{
                                                        echo "<option>$province</option>";
                                                    }?>
                                                    <?php if(isset($provinces) && $provinces):?>
                                                    <?php foreach ($provinces as $row): ?>

                                                        <option value="<?=$row->province?>"><?=$row->province?></option>

                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                            <select name="municipy" class="js-municipy nice-select">
                                                <?php if($municipy == ""){
                                                    echo "<option>-- Municipio --</option>";
                                                }else{
                                                    echo "<option>$municipy</option>";
                                                }
                                                ?>
                                            </select>
                                            
                                            <label>
                                                Address <span>*</span>
                                            </label>
                                            <input name="address" type="text" onClick="this.select()" value="">
                                            <br>
                                            <div class="widget-posts-img">
                                                <input id="uploadImage" type="file" name="image" onchange="PreviewImage();">
                                                <img id="uploadPreview" src="<?=ASSETS.THEME?>defaultimg.jpg" alt="image">
                                            </div>
                                            <br>
                                            <label>
                                                Mensagem <span>*</span>
                                            </label>
                                            <input name="message" type="text" onClick="this.select()" value="">                                            
                                            <button type="submit" name="send_message" class="btn float-btn color2-bg">
                                                Enviar <i class="fas fa-caret-right"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!--tab end -->
                                
                            </div>
                            <!--tabs end -->
                            <div class="log-separator fl-wrap">
                                <span></span>
                            </div>
                            <div class="wave-bg">
                                <div class='wave -one'></div>
                                <div class='wave -two'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--register form end -->
            <a class="to-top">
                <i class="fas fa-caret-up"></i>
            </a>
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script src="<?=ASSETS.THEME?>js/jquery.min.js"></script>
        <script src="<?=ASSETS.THEME?>js/plugins.js"></script>
        <script src="<?=ASSETS.THEME?>js/scripts.js"></script>
        
        <script src="<?=ASSETS.THEME?>js/map-single.js"></script>
        <script src="js/charts.js"></script>
        <script src="js/dashboard.js"></script>
        <script src="<?=ASSETS.THEME?>admin/dist/js/sweetalert2.all.min.js"></script>
        <?php if(isset($_SESSION['success'])):?>
        <script>
        Swal.fire({
            icon: 'success',
            title: '<?=$_SESSION['success']?>',
            showConfirmButton: false,
            timer: 2000
        })
        </script>
        <?php endif; unset($_SESSION['success'])?>
        <!-- error alert -->
        <?php if(isset($_SESSION['error'])):?>
            <script>
            Swal.fire({
                icon: 'error',
                title: '<?=$_SESSION['error']?>',
                showConfirmButton: false,
                timer: 2000
            })
            </script>
        <?php endif; unset($_SESSION['error'])?>
    </body>
</html>

<script type="text/javascript">

  function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
  };

  function get_municipies(province) {
    console.log(province)
    send_data({
        id:province.trim()
    },"get_municipies");
  }

  function send_data(data = {},data_type) {
    var ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function(){

    if(ajax.readyState == 4 && ajax.status == 200)
    {
      handle_result(ajax.responseText);
    }
    });

    var info = {};
    info.data_type = data_type;
    info.data = data;

    ajax.open("POST","<?=ROOT?>ajax_province",true);
    ajax.send(JSON.stringify(info));

  }

  function handle_result(result)
		{
			if(result != ""){
				var obj = JSON.parse(result);

				if(typeof obj.data_type != 'undefined')
				{
          
					if(obj.data_type == "get_municipies"){
						//alert(result);
                        console.log(obj.data.length);
						var select_input = document.querySelector(".js-municipy");
                        //select_input.style.display=""
                        console.log(select_input);
						select_input.innerHTML = "<option>-- Municipio --</option>";
						for (var i = 0; i < obj.data.length; i++) {
							select_input.innerHTML += "<option value='"+obj.data[i].municipy+"'>"+obj.data[i].municipy+"</option>";
						}
					}
				}

			}


		}

</script>
