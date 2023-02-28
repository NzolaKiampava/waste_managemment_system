<?php $this->view("admin/header", $data);?>
<?php $this->view("admin/sidebar", $data);?>
<?php
    $date = date('d M, Y', time())
?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Geolocalização
        <small>Procurar contentores</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Geolocalização</li>
    </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
        <!-- The time line -->
        <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                <span class="bg-red">
                    <?= date('d M, Y', strtotime($last_msg[0]->date))?>
                </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
            <i class="fa fa-envelope bg-blue"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?= date('H:i', strtotime($last_msg[0]->date))?></span>

                <h3 class="timeline-header"><a href="#">Mensagem Recente</a> de pedido de colecta</h3>

                <div class="timeline-body">
                    <?=$last_msg[0]->message?>
                </div>
                <div class="timeline-footer">
                <a href="<?=ROOT?>admin/messages" class="btn btn-primary btn-xs">Todas mensagens</a>
                </div>
            </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
            <i class="fa fa-user bg-aqua"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> </span>

                <h3 class="timeline-header no-border"><a href="#"><?=$last_msg[0]->sender_name?></a>, username do emissor</h3>
            </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
            <i class="fa fa-comments bg-yellow"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?= date('d M, Y', strtotime($last_msg[0]->date))?></span>

                <h3 class="timeline-header"><a href="#">Endereço</a> enviado de colecta</h3>

                <div class="timeline-body">
                <?=$last_msg[0]->address?>
                </div>
                <div class="timeline-footer">
                <a href="<?=ROOT?>admin/address" class="btn btn-warning btn-flat btn-xs">Visualizar endereços</a>
                </div>
            </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <li class="time-label">
                <span class="bg-green">
                    <?=$date?>
                </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
            <i class="fa fa-camera bg-purple"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i></span>

                <h3 class="timeline-header"><a href="#">Imagens</a> últimas imagens enviadas</h3>

                <div class="timeline-body">
                    <?php if(is_array($last_msg_img)):?>
                        <?php foreach ($last_msg_img as $last_msg_img):?>
                            <img src="<?=ROOT.$last_msg_img->image?>" alt="message_image" class="margin" width="150" height="100">
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
            <i class="fa fa-video-camera bg-maroon"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?=$date?></span>

                <h3 class="timeline-header"><a href="#">Mr. <?=$user_data->name?></a> é mais fácil localizar no mapa</h3>

                <div class="timeline-body">
                <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.5410282694193!2d13.236210915317438!3d-8.829114492802091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a51f3a72fe6a54f%3A0x546f53fdbb8752b3!2sTech%20by%20tech!5e0!3m2!1spt-PT!2sus!4v1677520725377!5m2!1spt-PT!2sus" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0" allowfullscreen></iframe>
                    
                </div>
                </div>
                <div class="timeline-footer">
                <a href="#" class="btn btn-xs bg-maroon">Google Maps</a>
                </div>
            </div>
            </li>
            <!-- END timeline item -->
            <li>
            <i class="fa fa-clock-o bg-gray"></i>
            </li>
        </ul>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.row -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper 
<?php $this->view("admin/footer", $data);?>