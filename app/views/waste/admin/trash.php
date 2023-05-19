<?php $this->view("admin/header", $data);?>
    <?php $this->view("admin/sidebar", $data);?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Contentores de Lixo
            <small>Contentores de lixos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Baldee de Lixo</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Contentor de Lixo</h3>

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
            <div class="box-footer clearfix no-border">
              <a href="http://localhost/ultrasonic_wastems/" target="_blank"><button type="button" class="btn btn-default pull-right"><i class="fa fa-area-chart"></i>&nbsp; Ver Monitoramento </button></a>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Provincia</th>
                    <th>Municipio</th>
                    <th>Endereço</th>
                    <th>Estado</th>
                    <th>Criado por</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php if(is_array($trashes)):?> 
                            <?php foreach($trashes as $trash):?>
                                <?php
                                    $DB = Database::newInstance();  
                                    $id = $trash->created_by;
                                    $search = $DB->read("select * from users where id = '$id'");
                                    $search_add = $DB->read("select * from garbage_address where id = '$trash->address_id'");
                                ?>
                             <tr>
                                <td><img src="<?=ASSETS . THEME?><?php if($trash->status == 'full'){echo "/assets/logo/garbage-red.png";}elseif($trash->status == 'empty'){echo'/assets/logo/garbage.jpg';}else echo'/assets/logo/garbage-yellow.jpg';?>"  class="img-circle" height='30px' width='30px'></td>
                                <td><?=$trash->id?></td>
                                <td><?=$trash->name?></td>
                                <td><?=$trash->province?></td>
                                <td><?=$trash->municipy?></td>
                                <td><?=$search_add[0]->address?></td>
                                <td>
                                  <span class="

                                      <?php 
                                      
                                      if($trash->status=="empty"):?>
                                      label bg-green
                                      <?php elseif($trash->status=="middle"):?>
                                        label bg-yellow
                                      <?php else:?>
                                      label bg-red
                                      <?php endif;?>">
                                      <?php if($trash->status == "empty"):?>
                                        Vazio
                                      <?php elseif($trash->status == "middle"):?>
                                        Meio
                                      <?php else:?>
                                        Cheio
                                      <?php endif;?>
                                  </span>
                                </td>
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
        $('#edit_lat').val(response[0].lat);
        $('#edit_lng').val(response[0].lng);
        $('#addselected').val(response[0].address_id).html(response[0].address_id);
        $('#addselectedp').val(response[0].province).html(response[0].province);
        $('#addselectedm').val(response[0].municipy).html(response[0].municipy);
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

<script>
    setInterval(function(){
        // Use AJAX to fetch updated table data
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("table-body").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "<?=ROOT?>admin/update_table", true);
        xhttp.send();
    }, 5000); // Refresh after 5 seconds (you can change the time interval here)
</script>