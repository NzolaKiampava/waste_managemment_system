<?php 
  $User = $this->load_model('User');
  $user_data = $User->check_login(true, ["Administrador","Supervisor"]);

  if(is_object($user_data)){
    $data['user_data'] = $user_data;
  }
  $DB = Database::newInstance();
  $check = $DB->read("SELECT * from garbage_address");
?>
<!-- ADD -->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Cadastrar Empresa</h4>
          </div>
          <div class="modal-body">
            <form method="post">
              <p>Entrar com Nome da Empresa</p>
              <input type="text" name="empresa" placeholder="Nome da Empresa" autocomplete="off" class="form-control placeholder-no-fix" required>
              <br>
              <p>Entrar com Email</p>
              <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" required>
              <br>
              <p>Entrar com O NIF</p>
              <input type="text" minLength="9" maxLength="9" name="nif" placeholder="NIF" autocomplete="off" class="form-control placeholder-no-fix" required>
              <br>
              <p>Telefone</p>
              <input type="text" name="telefone" placeholder="Telefone" autocomplete="off" class="form-control placeholder-no-fix" required>
              <br>
              <p>Selecionar Provincia de Atuação</p>
              <select name="province" class="form-control" classname="js-country" oninput="get_municipies(this.value)" required><br><br>
                    <?php if($province == ""){
                      echo "<option>-- Provincia --</option>";
                    }else{
                      echo "<option>$province</option>";
                    }?>
                    <?php if(isset($provinces) && $provinces):?>
                      <?php foreach ($provinces as $row): ?>

                        <option value="<?=$row->province?>"><?=$row->province?></option>

                      <?php endforeach;?>
									 	<?php endif;?>
              </select><br>
              <p>Selecionar Municipio</p>
              <select name="municipy" class="js-municipy form-control" required>
                <?php if($municipy == ""){
                    echo "<option>-- Municipio --</option>";
                  }else{
                    echo "<option>$municipy</option>";
                  }
                ?>
              </select>
              <br>

              <p>Estado</p>
              <select name="status" class="form-control placeholder-no-fix" autocomplete="off" required>
                <option value="aprovado">Aprovado</option>
                <option value="nao_aprovado">Não Aprovado</option>
                <option value="pendente">Pendente</option>
              </select>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button"><i class="fa fa-close"></i> Cancelar</button>
                <button class="btn btn-success" name="add_empresa" type="submit"><i class="fa fa-save"></i> Salvar</button>
            </div>
          </form>
      </div>
  </div>
</div>
<!-- modal -->

<!-- Edit -->
<div class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Editar Empresa</b></h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <input type="hidden" class="userid" name="id">
              <p>Empresa</p>
              <input type="text" name="empresa" id="edit_empresa" placeholder="Nome da Empresa" autocomplete="off" class="form-control placeholder-no-fix" required>
              <p>Email</p>
              <input type="email" name="email" id="edit_email" placeholder="Email da Empresa" autocomplete="off" class="form-control placeholder-no-fix" required>
              <p>NIF</p>
              <input type="text" name="nif" id="edit_nif" placeholder="Nome do balde" autocomplete="off" class="form-control placeholder-no-fix" required>
              <p>Telefone</p>
              <input type="text" name="telefone" id="edit_telefone" placeholder="Nome do balde" autocomplete="off" class="form-control placeholder-no-fix" required>

              <p>Selecionar Provincia</p>
              <select name="province" id="edit_province" class="form-control" classname="js-country" oninput="get_municipies_edit(this.value)" required><br><br>
                    <option id="addselectedp"></option>
                    <?php if($province == ""){
                      echo "<option>-- Provincia --</option>";
                    }else{
                      echo "<option>$province</option>";
                    }?>
                    <?php if(isset($provinces) && $provinces):?>
                      <?php foreach ($provinces as $row): ?>

                        <option value="<?=$row->province?>"><?=$row->province?></option>

                      <?php endforeach;?>
									 	<?php endif;?>
              </select><br>
              <p>Selecionar Municipio</p>
              <select name="municipy" class="js-municip form-control" required>
  
                <option id="addselectedm"></option>
                <?php if($municipy == ""){
                    echo "<option>-- Municipio --</option>";
                  }else{
                    echo "<option>$municipy</option>";
                  }
                ?>
              </select>
              <br>

              <p>Estado</p>
              <select name="status" class="form-control placeholder-no-fix" autocomplete="off" required>
                <option selected id="statusselected"></option>
                <option value="aprovado">Aprovado</option>
                <option value="nao_aprovado">Não Aprovado</option>
                <option value="pendente">Pendente</option>
              </select>
            </div>
          <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button"><i class="fa fa-close"></i> Cancelar</button>
              <button class="btn btn-success" name="edit_empresa" type="submit"><i class="fa fa-save"></i> Salvar</button>
          </div>
          </form>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deletando...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETAR GRUPO</p>
                    <h2 class="bold trash_name"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete_trash"><i class="fa fa-trash"></i> Deletar</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="empresa"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="empresa_id" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Logo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload_photo"><i class="fa fa-check-square-o"></i> Atualizar</button>
              </form>
            </div>
        </div>
    </div>
</div> 



<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="empresa_id" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">FOTO</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="logo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload_photo"><i class="fa fa-check-square-o"></i> Atualizar</button>
              </form>
            </div>
        </div>
    </div>
</div> 



<!-- Activate -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activating...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_activate.php">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>ACTIVATE USER</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Activate</button>
              </form>
            </div>
        </div>
    </div>
</div> 



<script>
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

<script>
  function get_municipies_edit(province) {
    console.log(province)
    send_data_edit({
	  		id:province.trim()
	 	},"get_municipies");
  }

  function send_data_edit(data = {},data_type) {
    var ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function(){

    if(ajax.readyState == 4 && ajax.status == 200)
    {
      handle_result_edit(ajax.responseText);
    }
    });

    var info = {};
    info.data_type = data_type;
    info.data = data;

    ajax.open("POST","<?=ROOT?>ajax_province",true);
    ajax.send(JSON.stringify(info));

  }

  function handle_result_edit(result)
		{

			
			if(result != ""){
				var obj = JSON.parse(result);

				if(typeof obj.data_type != 'undefined')
				{
          
					if(obj.data_type == "get_municipies"){
						//alert(result);
            console.log(obj.data.length);
						var select_input = document.querySelector(".js-municip");
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

     