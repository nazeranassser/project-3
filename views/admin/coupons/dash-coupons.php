<?php include('views/partials/header_admin.php');?>

        <!--====== End - Main Header ======-->


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

                                        <a href="dash-address-book.php">Admins</a></li>
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
                                    
                                    ?><div>

                                    <a class="dash__custom-link btn--e-brand-b-2" href="/coupons-add"><i class="fas fa-plus u-s-m-r-8"></i>

                                        <span>Add New Coupon</span></a></div>
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
                                    <div class="dash__pad-2">
                                            <div class="dash__address-header">
                                                <h1 class="dash__h1">Coupons</h1>
                                            </div>
                                        </div>
                                        <div class="dash__table">
                                            <table class="dash__table">
                                                <thead>
                                                    <tr>
                                                        <th>Coupon Name</th>
                                                        <th>Coupon Amount</th>
                                                        <th>Coupon Active</th>
                                                        <th>Coupon Expire</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                
                                                // include('show_admin.php');
                                                
                                                  foreach($coupons as $coupon){
                                                    echo "  <tr>
                                                         <form method='POST' action='coupon-edit/".$coupon['coupon_id']."'>
                                                            <input type='hidden' value='".$coupon['coupon_id']."' name='coupon_ID''>
                                                            <th>".$coupon['coupon_value']."<input type='hidden' value='".$coupon['coupon_value']."' name='coupon_ID''></th>
                                                            <th>".$coupon['coupon_amount']." JD<input type='hidden' value='".$coupon['coupon_amount']."' name='coupon_amount''></th>
                                                            <th>Active</th>
                                                            <th>".$coupon['coupon_expire']."<input type='hidden' value='".$coupon['coupon_expire']."' name='coupon_expire''></th>
                                                            <th style='display: flex;''>
                                                            <input type='hidden' value='".$coupon['coupon_id']."' name='edit''>
                                                            <button type='submit' class='address-book-edit btn--e-transparent-platinum-b-2' style='margin-right:4px ;'>Edit</button></form>
                                                            <form method='POST' action='coupon-delete'>
                                                            <input type='hidden' value='".$coupon['coupon_id']."' name='delete_coupon''>
                                                            <button type='submit' class='address-book-edit btn--e-transparent-platinum-b-2'>Delete</button></form></th>
                                                        </tr>";
                                                }
                                                ?>
                                                </tbody>
                                            </table>
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
