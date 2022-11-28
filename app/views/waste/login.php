<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css"
  rel="stylesheet"
/>

<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    .h-custom {
        height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="<?=ASSETS . THEME?>/assets/img/gallery/garbage-truck-trash-recycling-factory-waste-sorting-transport-vehicle-innovative-technology-isometric-illustration-green-eco-234230240.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">
          <!--
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-twitter"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-linkedin-in"></i>
            </button>
          </div>
          
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div>
        -->
          <div class="divider d-flex align-items-center my-4">
            <p class="lead fw-normal mb-0 me-3"><img src="<?=ASSETS.THEME?>assets/logo/logo.png" width="70">ITEL PAP 2022</p>
          </div>
          <div class="divider d-flex align-items-center my-4">
            <p class="lead fw-normal mb-0 me-3">Login</p>
          </div>
          <span style="font-size: 18px; color: red;"><?php check_error() ?></span><br>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" id="form3Example3" class="form-control form-control-lg"
              placeholder="Entrar com um nome valido" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '';?>" />
            <label class="form-label" for="form3Example3">Nome do Usuário</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '';?>" />
            <label class="form-label" for="form3Example4">Password</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input onclick="show_password()" class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Ver Password
              </label>
            </div>
            <a href="<?=ROOT?>recover_password" class="text-body">Esqueceu-se da Password?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Não tem uma conta? <a href="<?=ROOT?>signup" class="link-danger">Registrar</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>

  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2022. Made by Nzola &amp; Délcio.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>


<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"
></script>

<script>
  
  function show_password()
  {
    mypass = document.getElementById('form3Example4');
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


