
<!-- ADD -->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Adicionar novo Usuário</h4>
          </div>
          <div class="modal-body">
            <form method="post">
              <p>Entrar com Nome do usuário</p>
              <input type="text" name="name" placeholder="Nome do usuário" autocomplete="off" class="form-control placeholder-no-fix" required>
              <p>Entrar com email</p>
              <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" required>

              <p>Selecionar perfil </p>
              <select name="rank" class="form-control placeholder-no-fix" autocomplete="off" required>
              <option value="Administrador">Administrador</option>
              <option value="Normal" selected>Usuario Normal</option>
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