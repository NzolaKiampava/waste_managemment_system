<?php $this->view("dashboard_userheader", $data);?>
                            <!-- dashboard-menu  end-->
                            <!-- dashboard content-->
                            <div class="col-md-9">
                                <div class="dashboard-title   fl-wrap">
                                    <h3>Change Password</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <div class="profile-edit-container fl-wrap block_box">
                                    <div class="custom-form">
                                        <form method="POST">
                                            <div class="pass-input-wrap fl-wrap">
                                                <label>Current Password</label>
                                                <input type="password" class="pass-input" name="current_password" placeholder="" required/>
                                                <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                                            </div>
                                            <div class="pass-input-wrap fl-wrap">
                                                <label>New Password</label>
                                                <input type="password" class="pass-input" name="new_password" placeholder="" required/>
                                                <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                                            </div>
                                            
                                            <button class="btn    color2-bg  float-btn" name="change_password" type="submit">Save Changes<i class="fal fa-save"></i></button>
                                        </form>
                                    </div>
                                </div>
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