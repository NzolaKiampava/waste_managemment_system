<?php $this->view("admin/header", $data);?>

<?php $this->view("admin/sidebar", $data);?>
<style>
  .dragging{
    border: dashed 2px #448aff;
  }
</style>
<?php
   $image = 'uploads/user.jpg';
   if (file_exists($user_data->image)) //looking for if exist some file int the collumn image
   {
        $image = $user_data->image;
   }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil do Usuário
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <form method="POST" enctype="multipart/form-data">
        <div id="myform" class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" ondragover="handle_drap_and_drop(event)" ondrop="handle_drap_and_drop(event)" ondragleave="handle_drap_and_drop(event)" src="<?=ROOT.$image?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?=$user_data->name?></h3>

              <p class="text-muted text-center"><?=$user_data->rank?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Criou em</b> <a class="pull-right"><?=date('M d, Y', strtotime($user_data->date))?></a>
                </li>
                <li class="list-group-item">
                  <b>Usuar. criados</b> <a class="pull-right"><?=is_array($user_created)?count($user_created):'0'?></a>
                </li>
              </ul>

              <label for="change_image_input" id="change_image_button" class="btn btn-primary btn-block"><b>Trocar Imagem</b></label>
              <input class="form-control" type="file" onchange="upload_profile_image(this.files)" id="change_image_input" style="display:none">
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sobre Mim</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-user margin-r-5"></i> Nome Completo</strong>

              <p class="text-muted">
                <?=$user_data->name?>
              </p>

              <hr>

              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="text-muted"><?=$user_data->email?></p>

              <hr>

              <strong><i class="fa fa-group margin-r-5"></i> Perfil</strong>

              <p>
                <span class="label label-danger"><?=$user_data->rank?></span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Registro</strong>

              <p>Criou conta em, <?=date('M d, Y', strtotime($user_data->date))?>.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Settings</a></li>
              <!--<li><a href="#timeline" data-toggle="tab">Timeline</a></li>-->
              <!--<li><a href="#settings" data-toggle="tab">Settings</a></li>-->
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <?php if(isset($errors) && $errors != ""): ?>
                    <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong><?=$errors?></strong></div>
                  <?php endif;?>
                <div class="form-horizontal">
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                    
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="<?=$user_data->name?>" id="inputName" placeholder="Name">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                      </div>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="<?=$user_data->email?>">
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <?php if($user_data->rank == "Administrador"):?>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Perfil</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-group"></i>
                      </div>
                      <div class="col-sm-10">
                      <select name="rank" class="form-control select2" style="width: 100%;">
                        <option value="<?=$user_data->rank?>" selected="selected"><?=$user_data->rank?></option>
                        <option value="Administrador">Administrador</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Normal">Normal</option>
                      </select>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <?php endif;?>
                  <small><i class="fa fa-spinner"></i> Mudar Password</small>
                  <hr>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Password Atual</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div>
                      <div class="col-sm-10">
                        <input type="password" name="current_password" id="current_password" class="form-control" value="<?=isset($POST['current_password']) ? $POST['current_password'] : '' ?>" placeholder="Colocar password atual">
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nova Password</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-bug"></i>
                      </div>
                      <div class="col-sm-10">
                        <input type="password" name="new_password" class="form-control" value="<?=isset($POST['new_password']) ? $POST['new_password'] : '' ?>" placeholder="Colocar nova password">
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input onclick="show_password()" type="checkbox"> Visualisar Password
                        </label>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="admin_profile_button" class="btn btn-danger">Submeter</button>
                    </div>
                  </div>
                </div>
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->

              <!--<div class="tab-pane" id="settings">
                <form method="post" class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" value="<?=$user_data->name?>" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" value="<?=$user_data->email?>" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>-->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        </form>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->view("admin/footer", $data);?>

  <!-- visualizar password -->
<script>
  function show_password()
  {
    mypass = document.getElementById('current_password');
    if (mypass.type == "text") 
      mypass.type = "password";
    else
      mypass.type = "text";
  }

  function _(element){
    return document.getElementById(element);
  }

  function upload_profile_image(files){ //files is an array
    var filename = files[0].name;   //retrieve the name of file
    var ext_start = filename.lastIndexOf(".");  //extation_start
    var ext = filename.substr(ext_start + 1, 3);

    if (!((ext == "jpg" || ext == "JPG") || (ext == "png" || ext == "PNG"))) {
      Swal.fire({
        icon: 'error',
        title: 'This file type of image is not allowed',
        showConfirmButton: false,
        timer: 2010
      })
      return;
    }

    var change_image_button = _("change_image_button");
    change_image_button.disabled = false;
    change_image_button.innerHTML = "Actualizando Imagem...";

    var myform = new FormData();  //declarating a new FormData object

    let ajax = new XMLHttpRequest();
    ajax.onload = function(){

        if (ajax.readyState == 4 || ajax.status == 200) {

            //alert(ajax.responseText);
            //get_data({}, "user_info"); //refreshing the user_info
            window.location = "<?=ROOT?>admin/profile";
            change_image_button.disabled = false;
            change_image_button.innerHTML = "Trocar Imagem";

        }
    }

    myform.append("files", files[0]); //appending files which files[0]
    myform.append("data_type", "change_profile_image"); //appending data_type which is Change im....

    ajax.open("POST", "<?=ROOT?>ajax_upload_profile_pic", true);
    ajax.send(myform);

  }

  function handle_drap_and_drop(e){  //dragging, drop and leave image

    if(e.type == "dragover"){

        e.preventDefault();  //prevenir o comportamento padrao de sustituir a imagem na pagina
        e.target.className = "profile-user-img img-responsive img-circle dragging";

    }

    else if(e.type == "dragleave"){

        e.target.className = "profile-user-img img-responsive img-circle";

    }

    else if(e.type == "drop"){

        e.preventDefault();  //prevenir o comportamento padrao de sustituir a imagem na pagina
        e.target.className = "profile-user-img img-responsive img-circle";
        //console.log(e.dataTransfer.files);
        upload_profile_image(e.dataTransfer.files); //calling the function to upload the image

    }
  }

</script>
