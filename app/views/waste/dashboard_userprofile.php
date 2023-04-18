<?php $this->view("dashboard_userheader", $data);?>
                            <!-- dashboard content-->
                            <div class="col-md-9">
                                <div class="dashboard-title fl-wrap">
                                    <h3>Seu Perfil</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="profile-edit-container fl-wrap block_box">
                                        <div class="custom-form">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Nome Completo <i class="fal fa-user"></i></label>
                                                    <input type="text" name="name" placeholder="John Doe" value="<?=$user_data->name?>"/>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Endereço do Email<i class="far fa-envelope"></i>  </label>
                                                    <input type="email" name="email" placeholder="johndoe@domain.com" value="<?=$user_data->email?>"/>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <label>Mudar o Avatar</label> 
                                            <div class="clearfix"></div>
                                            <div class="listsearch-input-item fl-wrap">
                                                <div class="fuzone">
                                                    
                                                    <div class="fu-text">
                                                        <span><i class="fal fa-images"></i> Clica aqui ou arrasta a foto</span>
                                                        <div class="photoUpload-files fl-wrap"></div>
                                                    </div>
                                                    <input type="file" name="image" class="upload" multiple>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- profile-edit-container end-->
                                    <!-- profile-edit-container-->
                                    <div class="profile-edit-container fl-wrap block_box">
                                        <div class="custom-form">
                                            <button class="btn    color2-bg  float-btn" name="edit_profile" type="submit">Salvar Alterações<i class="fal fa-save"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <!-- profile-edit-container end-->
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