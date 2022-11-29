
<!-- ADD -->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Adicionar novo Grupo</h4>
          </div>
          <div class="modal-body">
            <form method="post">
              <p>Entrar com Nome do grupo</p>
              <input type="text" name="group" placeholder="Nome do grupo" autocomplete="off" class="form-control placeholder-no-fix" required>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button"><i class="fa fa-close"></i> Cancelar</button>
                <button class="btn btn-success" name="add_group" type="submit"><i class="fa fa-save"></i> Salvar</button>
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
            <h4 class="modal-title"><b>Editar Usuário</b></h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <input type="hidden" class="userid" name="id">

              <p>Nome do Grupo</p>
              <input type="text" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Nome do Grupo" id="edit_group" name="group" required>
          </div>
          <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button"><i class="fa fa-close"></i> Cancelar</button>
              <button class="btn btn-success" name="edit_group" type="submit"><i class="fa fa-save"></i> Salvar</button>
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
                    <h2 class="bold groupname"></h2>
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
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">FOTO</label>

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

     