<?php $this->view("admin/header", $data);?>
    <?php $this->view("admin/sidebar", $data);?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Pedidos de Colecta
            <small>Todas as mensagens</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mensagens</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            
            <div class="box-header with-border">
            <h3 class="box-title">Mensagens</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
            </div>
              
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Endereço do Balde</th>
                    <th>Mensagem</th>
                    <th>Data do envio</th>
                    <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($messages)):?> 
                            <?php foreach($messages as $message):?>
                                <?php
                                if (file_exists($message->image))
                                    $image = $message->image;
                                else
                                $image = 'uploads/user.jpg';
                            ?>
                            <tr>
                                <td><img src="<?=ROOT.$image?>" height='100px' width='100px'></td>
                                <td><?=$message->sender_name?></td>
                                <td><?=$message->address?></td>
                                <td><?=$message->message?></td>
                                <td><?=date('M d, Y', strtotime($message->date))?></td>
                                <td>
                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id="<?=$message->id?>"><i class='fa fa-trash'></i> Delete</button>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include 'includes/message_modal.php'; ?>
<?php $this->view("admin/footer", $data);?>

<script>
  $(function(){

    $(document).on('click', '.delete', function(e){
      e.preventDefault();
      $('#delete').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

  });

  function getRow(id){
    $.ajax({
      type: 'POST',
      url: '<?=ROOT?>admin/message_row',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        //console.log(response);
        $('.id').val(response[0].id);
        $('.sender_name').html(response[0].sender_name);
      }
    });
  }
</script>