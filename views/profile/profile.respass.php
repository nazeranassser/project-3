<?php include('views/partials/header.php'); ?> 
<link rel="stylesheet" href="public/css/app.css">



<!-- <div style="display: flex; text-align: center; padding-bottom: 60px;padding-top: 60px;">
    <div class="col-lg-9 col-md-12" >
        <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white" > 
            <div class="dash__pad-2" >

                <h1>Reset Passwprd</h1>
                <input type="text" name="" id="">
               
            </div>
        </div>
    </div>
</div> -->
<div class="col-lg-9 col-md-12">
                                <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                    <div class="dash__pad-2">
                                        <h1 class="dash__h1 u-s-m-b-14">Reset Password</h1>
                                        <span class="dash__text u-s-m-b-30">Looks like you haven't updated your profile</span>
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form method="POST" class="dash-edit-p" enctype="multipart/form-data" action="profile-update">
                                                    <div class="gl-inline">
                                                        <div class="u-s-m-b-30">
                                                            <input type="hidden" name="id" >
                                                            <label class="gl-label" for="reg-fname">Old Password</label>
                                                            <input class="input-text input-text--primary-style" name="oldpass" type="password" id="reg-fname" 
                                                                 required>
                                                        </div>
                                                        <div class="u-s-m-b-30">
                                                            <label class="gl-label" for="reg-email">New Password</label>
                                                            <input class="input-text input-text--primary-style" name="newpass" type="password" id="reg-email" 
                                                                required>
                                                        </div>
                                                    </div>
                                                    <button class="btn" name="edit" type="submit">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>








<?php include('views/partials/footer.php') ?>