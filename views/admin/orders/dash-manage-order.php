<?php
include('views/partials/header_admin.php');
// var_dump($orders);
// die();
?>

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

                                        <a>Order Details</a></li>
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
                                    <h1 class="dash__h1 u-s-m-b-30">Order Details</h1>
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <div class="dash-l-r">
                                                <div>
                                                    <div class="manage-o__text-2 u-c-secondary">Order #<?php echo $orders[0]['order_id'] ?></div>
                                                    <div class="manage-o__text u-c-silver">Placed on <?php echo $orders[0]['created_at']?></div>
                                                </div>
                                                <div>
                                                    <div class="manage-o__text-2 u-c-silver">Total:

                                                        <span class="manage-o__text-2 u-c-secondary">$<?php echo $orders[0]['order_total_amount_after']?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <div class="manage-o">
                                                <div class="manage-o__header u-s-m-b-30">
                                                    <div class="manage-o__icon"><i class="fas fa-box u-s-m-r-5"></i>

                                                        <span class="manage-o__text">Package 1</span></div>
                                                </div>
                                                <div class="dash-l-r">
                                                    <div class="manage-o__text u-c-secondary">Delivered on 26 Oct 2016</div>
                                                    <div class="manage-o__icon" style="display:flex;align-items:center;"><i class="fas fa-truck u-s-m-r-5" style="padding:10px"></i>

                                                    <form method="GET" action="/order-status" id="categoryForm">
                                                    <input type='text' value='<?= $orders[0]['order_id'] ?>' name='id' style='visibility: hidden;display: none;'>
                                                    <select class="select-box select-box--primary-style" style="border-radius:6px ;<?= 'cancelled' == $orders[0]['order_status'] ? 'background-color:red;' : '' ?>" name="status" id="categoryFilter" onchange="this.form.submit()">
                                                        <option value="cancelled" <?= 'cancelled' == $orders[0]['order_status'] ? 'selected' : 'style="background-color:red;"' ?>>Cancelled</option>
                                                            <option value='processing' 
                                                                <?= 'processing' == $orders[0]['order_status'] ? 'selected' : '' ?>>
                                                                Processing
                                                            </option>
                                                            <option value='shipped' 
                                                                <?= 'shipped' == $orders[0]['order_status'] ? 'selected' : '' ?>>
                                                                Shipped
                                                            </option>
                                                            <option value='delivered' 
                                                                <?= 'delivered' == $orders[0]['order_status'] ? 'selected' : '' ?>>
                                                                Delivered
                                                            </option>
                                                    </select>
                                                </form></div>
                                                </div>
                                                <div class="manage-o__timeline">
                                                    <?php
                                                        $finish1 ='';
                                                        $finish2 ='';
                                                        $finish3 ='';
                                                        if($orders[0]['order_status'] == 'processing'){
                                                            $finish1 ='timeline-l-i--finish';
                                                        }else if($orders[0]['order_status'] == 'shipped'){
                                                            $finish1 ='timeline-l-i--finish';
                                                            $finish2 ='timeline-l-i--finish';
                                                        }else if($orders[0]['order_status'] == 'delivered'){
                                                            $finish1 ='timeline-l-i--finish';
                                                            $finish2 ='timeline-l-i--finish';
                                                            $finish3 ='timeline-l-i--finish';
                                                        };
                                                    ?>
                                                    <div class="timeline-row">
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                                <?php
                                                                echo "<div class='timeline-l-i ".$finish1."'>"
                                                                ?>
                                                                    <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">Processing</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                            <?php
                                                                echo "<div class='timeline-l-i ".$finish2."'>"
                                                                ?>

                                                                    <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">Shipped</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 u-s-m-b-30">
                                                            <div class="timeline-step">
                                                            <?php
                                                                echo "<div class='timeline-l-i ".$finish3."'>"
                                                                ?>

                                                                    <span class="timeline-circle"></span></div>

                                                                <span class="timeline-text">Delivered</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    foreach($orders as $items) {
                                                    // var_dump($items);
                                                //     die();
                                                    echo "  <div class='manage-o__description' style='padding-top:20px'>
                                                    <div class='description__container'>
                                                        <div class='description__img-wrap'>

                                                            <img class='u-img-fluid' src='/".$items['product_image']."' alt=''></div>
                                                        <div class='description-title'>".$items['product_name']."</div>
                                                    </div>
                                                    <div class='description__info-wrap'>
                                                        <div>

                                                            <span class='manage-o__text-2 u-c-silver'>Quantity:

                                                                <span class='manage-o__text-2 u-c-secondary'>".$items['quantity']."</span></span></div>
                                                        <div>

                                                            <span class='manage-o__text-2 u-c-silver'>Total:

                                                                <span class='manage-o__text-2 u-c-secondary'>$".$items['quantity']*$items['product_price']."</span></span></div>
                                                    </div>
                                                </div>";
                                            }
                                                ?>
                                                <!--  -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Shipping Address</h2>
                                                    <h2 class="dash__h2 u-s-m-b-8"><?php echo $orders[0]['customer_name']?></h2>

                                                    <span class="dash__text-2"><?php echo $orders[0]['customer_address1']?></span>

                                                    <span class="dash__text-2"><?php echo $orders[0]['customer_phone']?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="dash__box dash__box--bg-white dash__box--shadow u-h-100">
                                                <div class="dash__pad-3">
                                                    <h2 class="dash__h2 u-s-m-b-8">Total Summary</h2>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Subtotal</div>
                                                        <div class="manage-o__text-2 u-c-secondary">$<?php echo $orders[0]['order_total_amount']?>.0</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Shipping Fee</div>
                                                        <div class="manage-o__text-2 u-c-secondary">$0.00</div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Coupon</div>
                                                        <?php echo "<div class='manage-o__text-2 ' style='color:#ff4500'>- $".$orders[0]['coupon_amount']."</div>"?>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary">Total</div>
                                                        <div class="manage-o__text-2 u-c-secondary">$<?php echo $orders[0]['order_total_amount_after']?></div>
                                                    </div>
                                                    <div class="dash-l-r u-s-m-b-8">
                                                        <div class="manage-o__text-2 u-c-secondary"><span class="dash__text-2">Paid by Cash on Delivery</span></div>
                                                        <div class="manage-o__text-2 u-c-secondary">
                                                            <!-- <form class="dash-address" action="" method="">
                                                                <button class="btn " type="submit">Cancel</button>
                                                            </form> -->
                                                        </div>
                                                    </div>
                                                </div>
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
        <?php
include('views/partials/footer_admin.php');
?>
      