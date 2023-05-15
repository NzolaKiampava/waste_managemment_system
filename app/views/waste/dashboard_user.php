<?php $this->view("dashboard_userheader", $data);?>
                            <!-- dashboard content-->
                            <div class="col-md-9">
                                <div class="dashboard-title fl-wrap">
                                    <h3>Tua Estatistica</h3>
                                </div>
                                <!-- list-single-facts -->
                                <div class="list-single-facts fl-wrap">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- inline-facts  -->
                                            <div class="inline-facts-wrap gradient-bg ">
                                                <div class="inline-facts">
                                                    <i class="fal fa-comments-alt"></i>
                                                    <div class="milestone-counter">
                                                        <div class="stats animaper">
                                                            <div class="num" data-content="0" data-num="<?=is_array($user_message)?count($user_message):'0'?>"><?=is_array($user_message)?count($user_message):'0'?></div>
                                                        </div>
                                                    </div>
                                                    <h6>Total de Mensaens Enviadas</h6>
                                                </div>
                                                <div class="stat-wave">
                                                    <svg viewbox="0 0 100 25">
                                                        <path fill="#fff" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- inline-facts end -->
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="dashboard-title dt-inbox fl-wrap">
                                    <h3>Actividade Recentes</h3>
                                </div>
                                <!-- dashboard-list-box-->
                                <div class="dashboard-list-box  fl-wrap">
                                    
                                    <!-- dashboard-list end-->
                                    <!-- dashboard-list end-->
                                    <?php if(is_array($user_message)):?>
                                        <?php foreach($user_message as $message):?>
                                            <div class="dashboard-list fl-wrap">
                                                <div class="dashboard-message">
                                                    <span class="new-dashboard-item"><i class="fal fa-circle"></i></span>
                                                    <div class="dashboard-message-text">
                                                        <i class="fal fa-comments-alt red-bg"></i>
                                                        <p> <?=$message->message?> </p>
                                                    </div>
                                                    <div class="dashboard-message-time"><i class="fal fa-calendar-week"></i> <?=date('d M, Y', strtotime($message->date))?></div>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                    <!-- dashboard-list end-->
                                </div>
                                <!-- dashboard-list-box end-->
                            </div>
                            <!-- dashboard content end-->
                        </div>
                    </section>
                    <!--  section  end-->
                    <div class="limit-box fl-wrap"></div>
                </div>
                <!--content end-->
            </div>
            <!-- wrapper end-->
            <!--footer -->
<?php $this->view("inner_footer", $data);?>