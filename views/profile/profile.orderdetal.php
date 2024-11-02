<?php  include('views/partials/header.php');  ?>


<link rel="stylesheet" href="../../public/css/order.css">


    <div class="order1" style=" padding-bottom: 90px;padding-top: 90px">
    <div class="order-container">
        <h1>Order Details</h1>
        <div class="order-info">
            <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['order_ID']); ?></p>
            <p><strong>Order Date:</strong> <?php echo date('Y-m-d H:i:s', strtotime($order['order_date'])); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
            <p><strong>Total Amount:</strong> $<?php echo number_format($order['total_amount'], 2); ?></p>
        </div>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grand_total = 0;
                foreach ($order_details as $item): 
                    $item_total = $item['quantity'] * $item['product_price'];
                    $grand_total += $item_total;
                ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($item['product_image']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>"></td>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>$<?php echo number_format($item['product_price'], 2); ?></td>
                        <td>$<?php echo number_format($item_total, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
    
    <?php include('views/partials/footer.php'); ?>
   
