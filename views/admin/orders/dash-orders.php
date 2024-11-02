<?php
include('views/partials/header_admin.php');
?>
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

                                        <a href="index.php">Home</a></li>
                                    <li class="is-marked">

                                        <a>Orders</a></li>
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
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Orders</h1>

                                            <span class="dash__text u-s-m-b-30">Here you can see all products that have been delivered.</span>
                                            <form class="m-order u-s-m-b-30">
                                                <div class="m-order__select-wrapper">

                                                    <label class="u-s-m-r-8" for="my-order-sort">Show:</label><select class="select-box select-box--primary-style" id="my-order-sort">
                                                        <option selected>Last 5 orders</option>
                                                        <option>Last 15 days</option>
                                                        <option>Last 30 days</option>
                                                        <option>Last 6 months</option>
                                                        <option>Orders placed in 2018</option>
                                                        <option>All Orders</option>
                                                    </select></div>
                                            </form>
                                            <div class="m-order__list">
                                            <?php
                                                
                                                // include('show_admin.php');
                                                                                            
                                                // $order = new orders();
                                                // $order_row = $order->showOrders();
                                                  foreach($orders as $order) {
                                                        $status ='';
                                                        if($order['order_status'] == 'processing'){
                                                            $status ='badge--processing';
                                                        }else if($order['order_status'] == 'shipped'){
                                                            $status ='badge--shipped';
                                                        }else if($order['order_status'] == 'delivered'){
                                                            $status ='badge--delivered';
                                                        };
                                                    echo "<div class='m-order__get'>
                                                    <div class='manage-o__header u-s-m-b-30'>
                                                        <div class='dash-l-r'>
                                                            <div>
                                                                <div class='manage-o__text-2 u-c-secondary'>Order #".$order['order_id']."</div>
                                                                <div class='manage-o__text u-c-silver'>Placed on ".$order['created_at']."</div>
                                                            </div>
                                                            <div>
                                                                <div class='dash__link dash__link--brand'>
                                                                 <form method='GET' action='/orderDetails'>
                                                                        <input type='text' value='".$order['order_id']."' name='id' style='visibility: hidden;display: none;'>
                                                                        <button type='submit' class='address-book-edit btn--e-transparent-platinum-b-2' style='border:0;color:#ff4500'><a>MANAGE</a></button>
                                                                    </form>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='manage-o__description'>
                                                        <div class='description__container'>
                                                            <div class='description__img-wrap'>

                                                                <img class='u-img-fluid' src='images/product/electronic/product3.jpg' alt=''></div>
                                                            <div class='description-title'>Yellow Wireless Headphone</div>
                                                        </div>
                                                        <div class='description__info-wrap'>
                                                            <div>

                                                                <span class='manage-o__badge ".$status."'>".$order['order_status']."</span></div>
                                                            <div>

                                                                <span class='manage-o__text-2 u-c-silver'>Quantity:

                                                                    <span class='manage-o__text-2 u-c-secondary'>1</span></span></div>
                                                            <div>

                                                                <span class='manage-o__text-2 u-c-silver'>Total:

                                                                    <span class='manage-o__text-2 u-c-secondary'>$".$order['order_total_amount_after']."</span></span></div>
                                                        </div>
                                                    </div>
                                                </div>";
                                                  }
                                                  ?>
                                            </div>
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
