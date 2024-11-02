<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="images/favicon.png" rel="shortcut icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/style.css"> <!-- Adjust path if needed -->

    <!-- Additional Vendor CSS -->
    <link rel="stylesheet" href="../../public/css/vendor.css"> <!-- Adjust path if needed -->
    <link rel="stylesheet" href="../../public/css/utility.css">
    <link rel="stylesheet" href="../../public/css/app.css">


</head>

<body>

    <!--====== Main Header ======-->
    <?php include 'views/partials/header.php'; ?>
    <!--====== End - Main Header ======-->

    <!--====== Cart Content ======-->
    <div id="app">

        <!--====== Section 1 ======-->
        <!--====== End - Section 1 ======-->

        <!--====== Section 2 ======-->

        <div class="shopping-cart__intro u-s-m-b-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shopping-cart__text-wrap">
                    <h1 class="shopping-cart__heading u-c-secondary">SHOPPING CART</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart items dynamically displayed -->
<div class="shopping-cart__content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                <div class="table-responsive">
                    <table class="cart-table">
                        <tbody class="cart-table__body">
                            <?php
                            $cartItems = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
                            ?>
                            <!-- Loop through cart items -->
                            <?php foreach ($cartItems as $productId => $item): ?>
                                <tr class="cart-table__row">
                                    <td>
                                        <div class="cart-table__box">
                                            <div class="cart-table__img-wrap">
                                                <img class="u-img-fluid"
                                                    src="/public/images/categories/<?php echo htmlspecialchars($item['image_url']); ?>"
                                                    alt="product image">
                                            </div>
                                            <div class="cart-table__info">
                                                <span class="cart-table__name">
                                                    <a
                                                        href="product/<?php echo htmlspecialchars($item['product_id']); ?>"><?php echo htmlspecialchars($item['product_name']); ?></a>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    <?php if ($item['discount'] > 0): ?>
                                                    <?php
                                                    $discountedPrice = $item['price'] - ($item['price'] * ($item['discount']));
                                                    ?>
                                                    <span class="original-price"><s style="color: red;"><?= number_format($item['price'], 2); ?>
                                                            JD</s></span>
                                                    <span class="discounted-price"><?= number_format($discountedPrice, 2); ?>
                                                        JD</span>
                                                <?php else: ?>
                                                    <?= number_format($item['price'], 2); ?> JD
                                                <?php endif; ?>                                    </td>
                                    <td>
                                        <div class="cart-table__input-counter-wrap">
                                            <!-- Quantity Counter -->
                                            <div class="input-counter">
                                                <span class="input-counter__minus fas fa-minus"></span>
                                                <input class="input-counter__text input-counter--text-primary-style"
                                                    type="text"
                                                    value="<?php echo htmlspecialchars($item['quantity']); ?>"
                                                    min="1"
                                                    max="<?php echo htmlspecialchars($item['stock_quantity']); ?>">
                                                <span class="input-counter__plus fas fa-plus"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cart-table__del-wrap">
                                            <a class="far fa-trash-alt cart-table__delete-link"
                                                href="/removeFromCart/<?php echo htmlspecialchars($item['product_id']); ?>"></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="route-box">
                    <div class="route-box__g1">
                        <a class="route-box__link" href="/">
                            <i class="fas fa-long-arrow-alt-left"></i>
                            <span>CONTINUE SHOPPING</span>
                        </a>
                    </div>
                    <div class="route-box__g2">
                        <a class="route-box__link" href="/clearCart">
                            <i class="fas fa-trash"></i>
                            <span>CLEAR CART</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Checkout button -->
<div class="checkout-button-container">
  <a href="/checkout">  <button class="checkout-button">Checkout</button></a>
</div>






    </div>
    </div>
    <!--====== Noscript ======-->
    <script>
       document.querySelectorAll('.input-counter').forEach(counter => {
    const minusBtn = counter.querySelector('.input-counter__minus');
    const plusBtn = counter.querySelector('.input-counter__plus');
    const inputField = counter.querySelector('.input-counter__text');

    // Decrease quantity when minus button is clicked
    minusBtn.addEventListener('click', () => {
        let value = parseInt(inputField.value);
        if (!isNaN(value) && value > 1) {
            inputField.value = value - 1;
        }
    });

    // Increase quantity when plus button is clicked
    plusBtn.addEventListener('click', () => {
        let value = parseInt(inputField.value);
        const maxValue = inputField.max ? parseInt(inputField.max) : Infinity; // Ensure max is considered if set
        if (!isNaN(value) && value < maxValue) {
            inputField.value = value + 1;
        }
    });

    // Validate input to prevent non-numeric characters
    inputField.addEventListener('input', () => {
        inputField.value = inputField.value.replace(/[^0-9]/g, '');
    });
});

    </script>

    <footer>
        <?php include 'views/partials/footer.php'; ?>
    </footer>

  

    
