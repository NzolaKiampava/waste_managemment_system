<?php $this->view("header", $data);?>

      <section class="py-0 bg-light-gradient">
        <div class="bg-holder" style="background-image:url(<?=ASSETS . THEME?>/assets/img/illustrations/hero-bg.png);background-position:top right;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 col-md-5 order-md-1 pt-8"><img class="img-fluid" src="<?=ASSETS . THEME?>/assets/img/gallery/webimg.webp" width="400" alt="" /></div>
            <div class="col-md-7 col-lg-6 text-center text-md-start pt-5 pt-md-9">
              <h1 class="display-2 fw-bold fs-4 fs-md-5 fs-xl-6">Construindo um <br />mundo saudável e verde.</h1>
              <p class="mt-3 mb-4">Tornar cidade mais limpa e inteligente por meio de Internet das Coisas e Inteligência Artificial.</p><a class="btn btn-lg btn-info rounded-pill me-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Enviar Mensagem </a><span> or  </span><a class="btn btn-lg btn-success rounded-pill me-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModa2" title="Video Demo"> <i class="fa fa-play"></i></a>
              <!-- Button trigger modal -->
              <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
              </button>-->
            </div>
          </div>
        </div>
      </section>

      
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Mensagem</h1>
        <small>Enviar uma Mensagem para de Colhecta de Lixo</small>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Nome Completo:</label>
              <input type="text" name="sender_name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="" class="col-form-label">Seleciona Provincia:</label>
              <select name="province" classname="js-country" oninput="get_municipies(this.value)" required>
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
              <select name="municipy" class="js-municipy" required>
                <?php if($municipy == ""){
                    echo "<option>-- Municipio --</option>";
                  }else{
                    echo "<option>$municipy</option>";
                  }
                ?>
              </select>
            </div>
            
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Endereço do Contentor:</label>
              <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Messagem:</label>
              <textarea name="message" class="form-control" id="message-text" required></textarea>
            </div>
            <div class="mb-3">
              <img id="uploadPreview" style="width: 200px; height: 200px;" /> 
              <input id="uploadImage" type="file" name="image" onchange="PreviewImage();" required/>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send message <i class="fa fa-send"></i></button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- END VIDEO MODAL-->


<!-- VIDEO MODAL -->
<div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">VIDEO DEMO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <video width="760" height="640" poster="<?=ASSETS.THEME?>assets/img/gallery/shutterstock.jpg" controls loop>
        <source src="<?=ASSETS.THEME?>videos/IoT Solutions - Smart Waste Management.mp4" type="video/mp4">
      </video>
      </div>
    </div>
  </div>
</div>
<!--- END VIDEO MODAL -->




            
            


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-6">

        <div class="container">
          <div class="row flex-center">
            <div class="col-auto text-center my-4">
              <h1 class="display-3 fw-bold">Monitoramento de Lixo<br /><span>com IOT</span></h1>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mb-5 mb-md-0"><img class="img-fluid shadow-sm" src="<?=ASSETS . THEME?>/assets/img/gallery/Smart-Waste-Recycling-System-1-1000x600.jpg" alt="" />
              <div class="mt-3 text-center text-md-start">
                <h4 class="display-6 fs-2 fs-lg-3 fw-bold">Espaços públicos limpos e seguros</h4>
                <p class="mb-0">Criar espaços públicos limpos e seguros é importante por vários motivos. Em primeiro lugar, ajuda a promover a saúde e a segurança pública, reduzindo o risco de lesões ou doenças.</p><a class="btn btn-link ps-0" href="#" role="button"> Smart Waste ›</a>
              </div>
            </div>
            <div class="col-md-4 mb-5 mb-md-0"><img class="img-fluid shadow-sm" src="<?=ASSETS . THEME?>/assets/img/gallery/garbage-sorting-waste-transportation-innovative-green-technology-eco-smart-system-for-recycling-clipart-vector_csp96689551.webp" width="310" alt="" />
              <div class="mt-3 text-center text-md-start">
                <h4 class="display-6 fs-2 fs-lg-3 fw-bold">Suporte à abordagem de desperdício zero</h4>
                <p class="mb-0">Ajude a criar um sentimento de orgulho e propriedade da comunidade, pois é mais provável que residentes e visitantes se sintam investidos em espaços limpos e bem conservados.</p><a class="btn btn-link ps-0" href="#" role="button"> Smart Waste › </a>
              </div>
            </div>
            <div class="col-md-4 mb-5 mb-md-0"><img class="img-fluid shadow-sm" src="<?=ASSETS . THEME?>/assets/img/gallery/garbage-truck-trash-recycling-factory-waste-sorting-transport-vehicle-innovative-technology-isometric-illustration-green-eco-234230240.jpg" alt="" />
              <div class="mt-3 text-center text-md-start">
                <h4 class="display-6 fs-2 fs-lg-3 fw-bold">Proibido jogar lixo</h4>
                <p class="mb-0">Ajude a atrair visitantes e investimentos para uma comunidade, pois empresas e residentes têm maior probabilidade de escolher áreas limpas e seguras para suas atividades.</p><a class="btn btn-link ps-0" href="#" role="button"> Smart Waste ›</a>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <div class="shapeup">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
          <path fill="#7854F7" fill-opacity="1" d="M0,64L120,69.3C240,75,480,85,720,85.3C960,85,1200,75,1320,69.3L1440,64L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
        </svg>
      </div>
      <section class="pt-4 pt-md-5 bg-info">
        <div class="bg-holder" style="background-image:url(<?=ASSETS . THEME?>/assets/img/illustrations/about-bg.png);background-position:center center;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row mb-5 text-center">
            <div class="col-12 col-md-4 mb-4"><img class="img-fluid rounded-3 shadow-lg image-up" src="<?=ASSETS . THEME?>/assets/img/gallery/about-2.png" alt="" /></div>
            <div class="col-12 col-md-8 text-md-start" style="max-width: 460px;">
              <h3 class="fw-medium text-light"> Clean & safe <br />public spaces</h3>
              <p class="text-light">Helps to promote public health and safety by reducing the risk of injury or illness. Second, it can help to create a sense of community pride and ownership, as residents and visitors are more likely to feel invested in spaces that are clean and well-maintained. Finally, it can help to attract visitors and investment to a community, as businesses and residents are more likely to choose areas that are clean and safe for their activities.</p><a class="btn btn-lg btn-success rounded-pill" href="#">Smart waste Management</a>
            </div>
          </div>
          <div class="row flex-center">
            <div class="col-12 col-md-4 order-0 order-md-1"><img class="img-fluid rounded-3 shadow-lg image-down" src="<?=ASSETS . THEME?>/assets/img/gallery/about-1.png" alt="" /></div>
            <div class="col-12 col-md-8 text-center text-md-start order-1 order-md-0" style="max-width: 460px;">
              <h3 class="fw-medium text-light">Zero waste <br />approach support</h3>
              <p class="text-light">There are many benefits to adopting a Zero Waste approach, including reducing the environmental impact of waste disposal, conserving natural resources, and reducing greenhouse gas emissions. However, transitioning to a Zero Waste approach can be challenging, especially for individuals, businesses, and communities that are used to traditional waste management practices.</p><a class="btn btn-lg btn-success rounded-pill" href="#">Read the Documentation</a>
            </div>
          </div>
        </div>
      </section>
      <div class="shapedown">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
          <path fill="#7854F7" fill-opacity="1" d="M0,256L120,250.7C240,245,480,235,720,234.7C960,235,1200,245,1320,250.7L1440,256L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"></path>
        </svg>
      </div>
      <section class="py-7 bg-light-gradient">
        <div class="bg-holder" style="background-image:url(<?=ASSETS . THEME?>/assets/img/gallery/testimonial-bg.png);background-position:center center;background-size:contain;">
        </div>
        <!--/.bg-holder-->

        <?php if(is_array($messages)):?>
        <div class="container">
          <div class="row flex-center mb-5">
            <div class="col-auto text-center">
              <h1 class="display-3 fw-bold fs-4 fs-md-6">ÚLTIMOS PEDIDOS<br /></h1>
            </div>
          </div>
          <div class="row flex-center">
            <div class="col-12 col-md-9 col-lg-8 col-xl-7 col-xxl-6">
              <div class="carousel slide carousel-fade" id="carouselExampleControls" data-bs-ride="carousel">
                <div class="carousel-inner overflow-visible">
                  <div class="card py-sm-6 px-sm-5 testimonial-card-shadow shadow-sm" style="transform: translateY(52px) scale(.9)"></div>
                  <div class="card py-sm-6 px-sm-5 testimonial-card-shadow shadow-sm" style="transform: translateY(32px) scale(.934)"></div>
                  <div class="card py-sm-6 px-sm-5 testimonial-card-shadow shadow-sm"></div>
                  <?php foreach($messages as $message):?>
                  <div class="carousel-item z-index-1 active">
                    <div class="card py-4 px-3 py-sm-6 px-sm-5 px-xl-7">
                      <div class="bg-holder mt-4" style="background-image:url(<?=ASSETS . THEME?>/assets/img/gallery/q.png);background-position:center top;background-size:150px;">
                      </div>
                      <!--/.bg-holder-->

                      <div class="card-body z-index-1">
                        <p class="card-text fs-2 text-center"><?=$message->message?> - <small><?=$message->address?></span></small>
                      </div>
                    </div>
                  </div>
                  <?php endforeach?>
                </div>
                <div class="row mt-7 pe-6">
                  <div class="col-12 position-relative text-end"><a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif;?>
      </section>
      <section class="bg-100 pb-0">
        <div class="container">
          <div class="row flex-center">
            <div class="col-xl-5 text-center mb-5 z-index-1">
              <h1 class="display-3 fw-bold fs-4 fs-md-6">Supported by real people</h1>
              <p>Our team of Happiness Engineers works remotely from 58 countries providing customer support across multiple time zones.</p>
            </div>
          </div>
        </div>
        <div class="position-relative text-center">
          <div class="bg-holder" style="background-image:url(undefined);background:url(<?=ASSETS . THEME?>/assets/img/gallery/people-bg-shape.png) no-repeat center bottom, url(<?=ASSETS . THEME?>/assets/img/gallery/people-bg-dot.png) no-repeat center bottom;">
          </div>
          <!--/.bg-holder-->
          <!--<img class="img-fluid position-relative z-index-1" src="<?=ASSETS . THEME?>/assets/img/gallery/people.png" alt="" />-->
          
        </div>
      </section>
      <section class="py-0">
        <div class="bg-holder z-index-2" style="background-image:url(<?=ASSETS . THEME?>/assets/img/illustrations/cta-bg.png);background-position:bottom right;background-size:61px 60px;margin-top:15px;margin-right:15px;margin-left:-58px;">
        </div>
        <!--/.bg-holder-->

       
<?php $this->view("footer", $data);?>

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
        
