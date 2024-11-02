<?php include('views/partials/header_admin.php');?>


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
                                        <a href="dash-address-add.html">Add Admins</a></li>
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
                                            <h1 class="dash__h1 u-s-m-b-14" style="padding-bottom: 10px;">Add new Coupon</h1>

                                            <form class="dash-address-manipulation" method="POST" action="new_coupon">
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="coupon_amount">Coupon Name *</label>
                                                        <input style="" class="input-text input-text--primary-style" name="coupon_name" step="0.01" type="text" id="coupon_name" placeholder="Coupon Name">

                                                    </div>
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="coupon_amount">Coupon Amount *</label>
                                                        <input style="" class="input-text input-text--primary-style" name="coupon_amount" step="0.01" type="number" id="coupon_amount" placeholder="Coupon Amount">

                                                    </div>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">
                                                         <label class="gl-label" for="coupon_expire">Coupon Expire *</label>
                                                         <input class="input-text input-text--primary-style" name="coupon_expire" type="date" id="coupon_expire" placeholder="2025-09-18">
                                                    </div>

                                                    <div class="u-s-m-b-30">
                                                            <!--====== Select Box ======-->
                                                        <label class="gl-label" for="address-country">Coupon Active *</label>
                                                        <select class="select-box select-box--primary-style" id="address-country">
                                                            <option selected value="1">Active</option>
                                                            <option value="0">DeActivate</option>
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
