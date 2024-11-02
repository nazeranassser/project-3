        <?php include('views/partials/header_admin.php');?>

        <!--====== End - Main Header ======-->

<br>
<br>
<br>
<br>
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-20">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="index.html">Home</a></li>
                                    <li class="is-marked">
                                        <a>Edit Admin</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="dash">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">

                                    <!--====== Dashboard Features ======-->
                                    <?php
                                    include('views/admin/dashboard_features.php');
                                    ?>
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14" style="padding-bottom: 10px;">Edit Admin</h1>

                                            <form class="dash-address-manipulation" method="POST" action="/update_admin">
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-name">NAME *</label>

                                                        <input class="input-text input-text--primary-style" name="admin_name" type="text" id="address-name" placeholder="First Name" value='<?php echo $admin['admin_name']?>'></div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-email">Email *</label>

                                                        <input class="input-text input-text--primary-style" name="email" type="email" id="address-email" placeholder="name@example.com" value='<?php echo $admin['admin_email']?>'></div>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="address-password">Password *</label>

                                                        <input class="input-text input-text--primary-style" name="password" type="password" id="address-password" ></div>
                                                        <div class="u-s-m-b-30">

                                                            <!--====== Select Box ======-->
                                                            <input type='text' value='<?php echo $admin['admin_id']?>' name='edit' style='visibility: hidden;display: none;'>

                                                            <label class="gl-label" for="address-country">Is Active *</label>
                                                            <select class="select-box select-box--primary-style" id="address-country" name="is_active">
                                                                <?php
                                                                   if($admin['is_active'] == 1) {
                                                                    echo "<option selected value='1'>Active</option>
                                                                            <option value='0'>Deactivate</option>";
                                                                   }else{
                                                                    echo "<option value='1'>Active</option>
                                                                            <option selected value='0'>Deactivate</option>";
                                                                   }
                                                                ?> 
                                                            </select>
                                                            <!--====== End - Select Box ======-->
                                                        </div>
                                                    </div>
                                                <button class="btn btn--e-brand-b-2" type="submit">SAVE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->
        </div>
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
        <?php include('views/partials/footer_admin.php');?>
        </div>
    <!--====== End - Main App ======-->

