
<!-- ADD -->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Adicionar novo Funcionarios</h4>
          </div>
          <div class="modal-body">
            <form method="post">
              <p>Entrar com Nome do usuário</p>
              <input type="text" name="name" placeholder="Nome do usuário" autocomplete="off" class="form-control placeholder-no-fix" required>
              <p>Entrar com email</p>
              <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" required>

              <p>Selecionar Cargo </p>
              <select name="rank" class="form-control placeholder-no-fix" autocomplete="off" required>
              <option value="Colector">Colector</option>
              <option value="Caminhonista">Caminhonista</option>
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
            <h4 class="modal-title"><b>Editar Usuário</b></h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="">
              <input type="hidden" class="userid" name="id">

              <p>Email</p>
              <input type="email" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Email" id="edit_email" name="email" required>

              <p>Nome</p>
              <input type="text" class="form-control placeholder-no-fix" autocomplete="off" id="edit_name" name="name" required>

              <p>Selecionar Cargo </p>
              <select name="rank" class="form-control placeholder-no-fix" autocomplete="off" required>
                <option selected id="rankselected"></option>
                <option value="Colector">Colector</option>
                <option value="Caminhonista">Caminhonista</option>
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
                    <p>DELETAR USUÁRIO</p>
                    <h2 class="bold fullname"></h2>
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

     
