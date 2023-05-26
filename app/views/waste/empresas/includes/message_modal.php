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
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>DELETAR MENSAGEM DO</p>
                    <h2 class="bold sender_name"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete_message"><i class="fa fa-trash"></i> Deletar</button>
              </form>
            </div>
        </div>
    </div>
</div>
