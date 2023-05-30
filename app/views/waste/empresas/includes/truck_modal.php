<?php 
		$trash = $this->load_model('Trash');
		$Empresa = $this->load_model('Infoempresa');
		$empresa_data = $Empresa->check_login(true, ["Empresa"]);

		if(is_object($empresa_data)){
			$data['user_data'] = $empresa_data;
			$id_empresa = $empresa_data->id;
			$data['id_empresa'] = $id_empresa;
		}
		$DB = Database::newInstance();
  $truck = $DB->read("SELECT * from colector_group where id_empresa = '$id_empresa'");
  $roots = $DB->read("SELECT * from garbage_address");
?>
<!-- ADD -->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Adicionar novo Caminhão</h4>
          </div>
          <div class="modal-body">
            <form method="post">
              <p>Entrar com Nome do Caminhão</p>
              <input type="text" name="name" placeholder="Nome do caminhão" autocomplete="off" class="form-control placeholder-no-fix" required>
              <p>Entrar com Matricula</p>
              <input type="text" name="registration" placeholder="Matricula" autocomplete="off" class="form-control placeholder-no-fix" required>

              <p>Selecionar Grupo </p>
              <select name="group_id" class="form-control placeholder-no-fix" autocomplete="off" required>
                <?php if(is_array($truck)):?>
                    <?php foreach($truck as $item):?>
                    <option value="<?=$item->id?>"><?=$item->group_name?></option>
                    <?php endforeach;?>
                <?php endif;?>
              </select>

              <p>Selecionar Primeiro endereço </p>
              <select name="address_id_1" class="form-control placeholder-no-fix" autocomplete="off" required>
                <?php if(is_array($roots)):?>
                    <?php foreach($roots as $item):?>
                    <option value="<?=$item->id?>"><?=$item->address?></option>
                    <?php endforeach;?>
                <?php endif;?>
              </select>

              <p>Selecionar Segundo endereço </p>
              <select name="address_id_2" class="form-control placeholder-no-fix" autocomplete="off" required>
                <?php if(is_array($roots)):?>
                    <?php foreach($roots as $item):?>
                    <option value="<?=$item->id?>"><?=$item->address?></option>
                    <?php endforeach;?>
                <?php endif;?>
              </select>

              <p>Selecionar Terceiro endereço </p>
              <select name="address_id_3" class="form-control placeholder-no-fix" autocomplete="off" required>
                <?php if(is_array($roots)):?>
                    <?php foreach($roots as $item):?>
                    <option value="<?=$item->id?>"><?=$item->address?></option>
                    <?php endforeach;?>
                <?php endif;?>
              </select>


            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button"><i class="fa fa-close"></i> Cancelar</button>
                <button class="btn btn-primary" name="add" type="submit"><i class="fa fa-save"></i> Salvar</button>
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
            <h4 class="modal-title"><b>Editar Caminhão</b></h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <input type="hidden" class="userid" name="id">

              <p>Nome</p>
              <input type="text" class="form-control placeholder-no-fix" autocomplete="off" id="edit_name" name="name" required>

              <p>Matricula</p>
              <input type="text" class="form-control placeholder-no-fix" autocomplete="off" id="edit_registration" name="registration" required>
              
              <p>Grupo de Colecta ID</p>
              <select name="group_id" class="form-control placeholder-no-fix" autocomplete="off" required>
                <option id="edit_group"></option>
                <?php if(is_array($truck)):?>
                    <?php foreach($truck as $item):?>
                    <option value="<?=$item->id?>"><?=$item->group_name?></option>
                    <?php endforeach;?>
                <?php endif;?>
              </select>

              <p>Primeiro endereço ID</p>
              <select name="address_id_1" class="form-control placeholder-no-fix" autocomplete="off" required>
              <option id="address_id_1"></option>
                <?php if(is_array($roots)):?>
                    <?php foreach($roots as $item):?>
                    <option value="<?=$item->id?>"><?=$item->address?></option>
                    <?php endforeach;?>
                <?php endif;?>
              </select>

              <p>Segundo endereço ID</p>
              <select name="address_id_2" class="form-control placeholder-no-fix" autocomplete="off" required>
              <option id="address_id_2"></option>
                <?php if(is_array($roots)):?>
                    <?php foreach($roots as $item):?>
                    <option value="<?=$item->id?>"><?=$item->address?></option>
                    <?php endforeach;?>
                <?php endif;?>
              </select>

              <p>Terceiro endereço ID</p>
              <select name="address_id_3" class="form-control placeholder-no-fix" autocomplete="off" required>
              <option id="address_id_3"></option>
                <?php if(is_array($roots)):?>
                    <?php foreach($roots as $item):?>
                    <option value="<?=$item->id?>"><?=$item->address?></option>
                    <?php endforeach;?>
                <?php endif;?>
              </select>

          </div>
          <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button"><i class="fa fa-close"></i> Cancelar</button>
              <button class="btn btn-primary" name="edit" type="submit"><i class="fa fa-save"></i> Salvar</button>
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
                    <p>DELETAR CAMINHÃO</p>
                    <h2 class="bold delete_name"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Deletar</button>
              </form>
            </div>
        </div>
    </div>
</div>     
