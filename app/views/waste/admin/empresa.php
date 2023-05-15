<?php $this->view("admin/header", $data);?>
    <?php $this->view("admin/sidebar", $data);?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Todas as Empresas
            <small>Empresas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Empresa de Residuos solidos</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Empresa de Residuos</h3>

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
                        <th>Logo</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Provincia</th>
                        <th>Municipio</th>
                        <th>NIF</th>
                        <th>Telefone</th>
                        <th>Estado</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                    <?php if(is_array($empresas)):?> 
                        <?php foreach($empresas as $empresa):?>
                            <?php
                                if (file_exists($empresa->logo))
                                    $image = ROOT.$empresa->logo;
                                else
                                $image = ASSETS.THEME.'defaultimg.jpg';
                            ?>
                            <tr>
                                <td>
                                    <img src="<?=$image?>" class="img-circle" height='30px' width='30px'>
                                    <span class="pull-right"><a href="#edit_photo" class="photo" data-toggle="modal" data-id="<?=$empresa->id?>"><i class="fa fa-edit"></i></a></span>
                                </td>
                                <td><?=$empresa->empresa?></td>
                                <td><?=$empresa->email?></td>
                                <td><?=$empresa->province?></td>
                                <td><?=$empresa->municipy?></td>
                                <td><?=$empresa->nif?></td>
                                <td><?=$empresa->telefone?></td>
                                <td>
                                    <span class="
                                        <?php if($empresa->status=="aprovado"):?>
                                        label bg-green
                                        <?php elseif($empresa->status=="nao_aprovado"):?>
                                        label bg-orange
                                        <?php else:?>
                                        label bg-primary
                                        <?php endif;?>"><?=$empresa->status?>
                                    </span>
                                </td>
                                <td><?=date('M d, Y', strtotime($empresa->created_at))?></td>
                                <td>
                                    <button class='btn btn-success btn-sm edit btn-flat' data-id="<?=$empresa->id?>"><i class='fa fa-edit'></i> Edit</button>
                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id="<?=$empresa->id?>"><i class='fa fa-trash'></i> Delete</button>
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
    <?php include 'includes/empresa_modal.php'; ?>
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
      url: '<?=ROOT?>admin/empresa_row',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        console.log(response);
        $('.empresaid').val(response[0].id);
        $('#edit_empresa').val(response[0].empresa);
        $('.empresa').val(response[0].empresa);
        $('#edit_email').val(response[0].email);
        $('#edit_nif').val(response[0].nif);
        $('#edit_telefone').val(response[0].telefone);
        $('#addselectedp').val(response[0].province).html(response[0].province);
        $('#addselectedm').val(response[0].municipy).html(response[0].municipy);
        $('#statusselected').val(response[0].status).html(response[0].status);
      }
    });
  }
</script>