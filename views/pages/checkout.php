<!--====== Main Header ======-->
<?php include 'views/partials/header.php';
?>
<!--====== End - Main Header ======-->

<!--====== Checkout Content ======-->
<!-- Delivery Information -->
<div class="container">
    <h1 class="section-title">DELIVERY INFORMATION & ORDER SUMMARY</h1>

    <!-- Flex Container for Delivery Info and Order Summary -->
    <div class="d-flex justify-content-between delivery-order-container">
        <!-- Delivery Info Section -->
        <div class="delivery-info flex-item">
            <h2>DELIVERY INFORMATION</h2>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($deliveryInfo['customer_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($deliveryInfo['customer_email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($deliveryInfo['customer_phone']); ?></p>

            <?php if (!empty($deliveryInfo['customer_address2'])): ?>
                <div class="address-selection">
                    <label><strong style="color:red;">Choose one of your addresses:</strong></label><br>
                    <label>
                        <input type="radio" name="selected_address"
                            value="<?php echo htmlspecialchars($deliveryInfo['customer_address1']); ?>" checked>
                        <strong>Address 1:</strong> <?php echo htmlspecialchars($deliveryInfo['customer_address1']); ?>
                    </label><br>
                    <label>
                        <input type="radio" name="selected_address"
                            value="<?php echo htmlspecialchars($deliveryInfo['customer_address2']); ?>">
                        <strong>Address 2:</strong> <?php echo htmlspecialchars($deliveryInfo['customer_address2']); ?>
                    </label>
                </div>
            <?php else: ?>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($deliveryInfo['customer_address1']); ?></p>
            <?php endif; ?>
        </div>

        <!-- Order Summary Section -->
        <div class="order-summary flex-item">
            <h2>ORDER SUMMARY</h2>
            <?php if (!empty($cartItems)): ?>
                <table class="order-summary-table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        ?>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td>
                                    <?php
                                        if ($item['discount'] > 0):?>
                                        <span class="original-price"><s style="color: red;"><?= number_format($item['price'], 2); ?>
                                                JD</s></span>
                                        <span class="discounted-price"><?= number_format($discounted_price, 2); ?> JD</span>
                                    <?php else: ?>
                                        <?= number_format($item['price'], 2); ?> JD
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <p class="order-total"><strong>Subtotal:</strong> <?php echo number_format($orderTotal, 2); ?>JD</p>
                <p class="order-total"><strong>Shipping:</strong> 4.00JD</p>
                <p class="order-total"><strong>Total:</strong> <?php echo number_format($total, 2); ?>JD</p>
            <?php else: ?>
                <p class="empty-cart-message">Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Payment Information Section -->
    <h2 class="section-title">PAYMENT INFORMATION</h2>
    <form action="placeOrder" method="post" class="payment-form">
        <div class="radio-box">
            <input type="radio" id="cash-on-delivery" name="payment_method" value="cod" checked>
            <label for="cash-on-delivery">Cash on Delivery</label>
        </div>
        <button type="submit" class="submit-button">PLACE ORDER</button>
    </form>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 24px;
        margin-bottom: 15px;
        color: #333;
        text-align: center;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
    }

    .delivery-order-container {
        display: flex;
        flex-direction: row;
        gap: 20px;
        margin-bottom: 30px;
    }

    .flex-item {
        flex: 1;
        padding: 15px;
        background-color: #fafafa;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .delivery-info p,
    .order-summary p {
        margin: 5px 0;
    }

    .order-summary-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    .order-summary-table th,
    .order-summary-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .order-summary-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .original-price {
        color: red;
    }

    .discounted-price {
        color: green;
        font-weight: bold;
    }

    .order-total {
        font-size: 16px;
        margin: 5px 0;
    }

    .empty-cart-message {
        color: #888;
        font-style: italic;
        text-align: center;
    }

    .applied-coupon {
        margin-top: 10px;
        font-weight: bold;
    }

    .payment-form {
        margin-top: 30px;
        padding: 15px;
        background-color: #fafafa;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .radio-box {
        margin-bottom: 10px;
    }

    .submit-button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #1f1f7a;
        /* Custom color from your preference */
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-button:hover {
        background-color: #333;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
</style>
<script>
    document.getElementById('apply-coupon').addEventListener('click', function () {
        const couponCode = document.getElementById('coupon-code').value;
        if (couponCode) {
            fetch('check_coupon.php?code=' + encodeURIComponent(couponCode))
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        // Update the total price
                        const discountAmount = data.discount; // Get discount from the response
                        const totalElement = document.getElementById('total-price');
                        const currentTotal = parseFloat(totalElement.innerText.replace('$', ''));
                        const newTotal = currentTotal - discountAmount;

                        // Update total display
                        totalElement.innerText = '$' + newTotal.toFixed(2);

                        // Change button to remove coupon
                        this.innerText = 'Remove Coupon';
                        this.setAttribute('id', 'remove-coupon');

                        // Clear the coupon input field
                        document.getElementById('coupon-code').value = '';
                    } else {
                        alert('Invalid coupon code.');
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            alert('Please enter a coupon code.');
        }
    });

    // Event listener for remove coupon button
    document.addEventListener('click', function (event) {
        if (event.target.id === 'remove-coupon') {
            // Reset the total price to original
            const totalElement = document.getElementById('total-price');
            const originalTotal = <?php echo json_encode(number_format($orderTotal + 4.00, 2)); ?>; // Store original total
            totalElement.innerText = originalTotal;

            // Change button back to apply
            event.target.innerText = 'Apply';
            event.target.setAttribute('id', 'apply-coupon');

            // Clear the coupon input field
            document.getElementById('coupon-code').value = '';
        }
    });
</script>

<footer>
    <?php include 'views/partials/footer.php'; ?>
</footer>

<!--====== Vendor Scripts ======-->
<script src="js/vendor.js"></script>

<!--====== App Scripts ======-->
<script src="js/app.js"></script>

<!--====== Noscript ======-->
<noscript>
    <div class="app-setting">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="app-setting__wrap">
                        <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>

                        <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a
                            JavaScript-capable browser.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</noscript>

</body>

</html>