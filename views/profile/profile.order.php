<?php include('views/partials/header.php'); ?>
<link rel="stylesheet" href="public/css/app.css">
<link rel="stylesheet" href="../../public/css/order.css">

<div class="app-content">
    <div class="u-s-p-b-60">
        <div class="section__content">
            <div class="dash">
                <div class="container">
                    <div class="row">
                        <!-- Sidebar Section -->
                        <div class="col-lg-3 col-md-12">
                            <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                <div class="dash__pad-1">
                                    <span class="dash__text u-s-m-b-16"><?php echo htmlspecialchars($_SESSION['usersName']); ?></span>
                                    <ul class="dash__f-list">
                                        <li><a href="profile-edit">Manage My Account</a></li>
                                        <li><a href="profile-main">My Profile</a></li>
                                        <li><a class="dash-active" href="/profile-order">My Orders</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Orders Section -->
                        <div class="col-lg-9 col-md-12">
                            <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                <div class="dash__pad-2">
                                    <h1 class="dash__h1 u-s-m-b-14">My Orders</h1>
                                    <span class="dash__text u-s-m-b-30">View all your orders placed.</span>

                                    <?php if (empty($orders)): ?>
                                        <div class="dash-l-r u-s-m-b-30">
                                            <div class="manage-o__text u-c-secondary">No orders found</div>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($orders as $order): 
                                            $product_names = explode('|', $order['product_names']);
                                            $product_images = explode('|', $order['product_images']);
                                            $quantities = explode('|', $order['quantities']);
                                        ?>
                                            <div class="order-card">
                                                <div class="order-header">
                                                    <h4>Order #<?php echo htmlspecialchars($order['order_id']); ?></h4>
                                                    <p>Placed on <?php echo htmlspecialchars(date('F j, Y', strtotime($order['created_at']))); ?></p>
                                                </div>

                                                <div class="order-content">
                                                    <div class="product-summary">
                                                        <img src="<?php echo htmlspecialchars($product_images[0]); ?>" alt="Product Image">
                                                        <p><?php echo htmlspecialchars($product_names[0]); ?></p>
                                                        <?php if (count($product_names) > 1): ?>
                                                            <span>+ <?php echo count($product_names) - 1; ?> more items</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="order-info">
                                                        <p>Status: <strong><?php echo htmlspecialchars($order['order_status']); ?></strong></p>
                                                        <p>Quantity: <?php echo array_sum($quantities); ?></p>
                                                        <p>Total: $<?php echo number_format($order['order_total_amount_after'], 2); ?></p>
                                                    </div>
                                                    <a href="orders-detail/<?php echo $order['order_id']; ?>" class="view-details-btn" style="color:rgb(210, 105, 30)">View Details</a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('views/partials/footer.php'); ?>
