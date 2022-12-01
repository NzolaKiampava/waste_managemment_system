<?php $this->view("admin/header", $data);?>
    <?php $this->view("admin/sidebar", $data);?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Blank page
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            
            <div class="box-header with-border">
            <h3 class="box-title">Title</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
            </div>
              
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-success pull-left" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i>&nbsp; Adicionar </button>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Estado</th>
                    <th>Criado por</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($trashes)):?> 
                            <?php foreach($trashes as $trash):?>
                                <?php
                                    $DB = Database::newInstance();  
                                    $id = $trash->created_by;
                                    $search = $DB->read("select * from users where id = '$id'");
                                    $search_add = $DB->read("select * from garbage_address where id = '$trash->address_id'");
                                ?>
                            <tr>
                                <td><img src="<?=ASSETS . THEME?><?=($trash->status == 'full')?'/assets/logo/garbage-red.png':'/assets/logo/garbage.jpg'?>" class="img-circle" height='30px' width='30px'></td>
                                <td><?=$trash->id?></td>
                                <td><?=$trash->name?></td>
                                <td><?=$search_add[0]->address?></td>
                                <td><?=$trash->status?></td>
                                <td><?=$search[0]->name?></td>
                                <td><?=date('M d, Y', strtotime($trash->created_at))?></td>
                                <td>
                                    <button class='btn btn-success btn-sm edit btn-flat' data-id="<?=$trash->id?>"><i class='fa fa-edit'></i> Edit</button>
                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id="<?=$trash->id?>"><i class='fa fa-trash'></i> Delete</button>
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
    <?php include 'includes/trash_modal.php'; ?>
<?php $this->view("admin/footer", $data);?>

<script>
  $(function(){

    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

    $(document).on('click', '.delete', function(e){
      e.preventDefault();
      $('#delete').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

    $(document).on('click', '.photo', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      getRow(id);
    });

    /*$('#select_address').change(function(){
      var val = $($this).val();
      if(val == 0){
        windows.location = '<?=ROOT?>admin/trash';
      }else{
        windows.location = '<?=ROOT?>admin/trash?address='+val;
      }
    });

    $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
    });*/

  });

  function getRow(id){
    $.ajax({
      type: 'POST',
      url: '<?=ROOT?>admin/trash_row',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        console.log(response);
        $('.userid').val(response[0].id);
        $('#edit_name').val(response[0].name);
        $('#addselected').val(response[0].address_id).html(response[0].address_id);
        $('#statusselected').val(response[0].status).html(response[0].status);
        $('.trash_name').html(response[0].name);
      }
    });
  }

  function getAddress(){
    $.ajax({
      type: 'POST',
      url: '<?=ROOT?>admin/address_fetch',
      dataType: 'json',
      success:function(response){
        console.log(response);
        $('#address').append(response);
        $('#edit_address').append(response);
      }
    });
  }
</script>
