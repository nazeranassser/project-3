<?php
// session_start();
// include('config.php');
// Include the database connection file

// Initialize $user as null
$user = null;

// Check if user is logged in
if (isset($_SESSION['customer_ID'])) {
    // Get user data
    $sql = "SELECT * FROM customers WHERE customer_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $_SESSION['customer_ID']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="images/favicon.png" rel="shortcut icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoJgGHa0roUOFzT1iNQ36PE8G5OeMySkAzYFCAFK5L9jAc" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet" />
    <title><?php echo $user ? 'Welcome, ' . htmlspecialchars($user['customer_name']) : 'Welcome to Our Website'; ?>
    </title>

    <title>Revoly Cake</title>

    <!--====== Google Font ======-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">

    <!--====== Vendor Css ======-->
    <link rel="stylesheet" href="public/css/vendor.css">

    <!--====== Utility-Spacing ======-->
    <link rel="stylesheet" href="public/css/utility.css">

    <!--====== App ======-->
    <link rel="stylesheet" href="public/css/app.css">

    <link rel="stylesheet" href="public/css/index.css">

    <link rel="stylesheet" href="public/css/style.css">

</head>

<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">

            <img class="preloader__img" src="../images/preloader.png" alt="">
        </div>
    </div>

    <!--====== Main App ======-->
    <div id="app">

        <!--====== Main Header ======-->
        <?php
        include_once 'views/partials/header.php';
        ?>
        <!--====== End - Main Header ======-->


        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== start - hero section ======-->
            <div id="hero-section">
                <div class="hero-content">
                    <h1 id="hero-text">Welcome to Our Cake Shop!</h1>
                    <p class="hero-welcome">Indulge in the sweetest treats, crafted with love and the finest ingredients
                        just for you.</p>
                    <a href="allProducts">
                        <button class="cta-button">Order Your Favorite Cake</button>
                    </a>
                </div>
            </div>


            <!--====== End - hero section ======-->






            <!--====== start - new arrivals ======-->
            <div class="new-arrivals-section">
                <div class="section-intro">
                    <div class="container d-flex flex-column align-items-center">
                        <h1 class="section-title">NEW ARRIVALS</h1>
                        <span class="section-subtitle">DISCOVER OUR LATEST PRODUCTS</span>
                    </div>
                </div>

                <div class="product-container">
                    <div class="container">
                        <div class="product-grid-new">
                            <?php foreach ($products as $product): ?>
                                <div class="product-card-custom">
                                    <div class="product-image-wrapper">
                                        <a href="product/<?= $product['product_id']; ?>">
                                            <img src="public/images/categories/<?= $product['product_image']; ?>"
                                                alt="<?= htmlspecialchars($product['product_name']); ?>">
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <span class="product-title">
                                            <?= htmlspecialchars($product['category_name']); ?>
                                        </span>
                                        <h3 class="product-name-custom">
                                            <a href="product/<?= $product['product_id']; ?>">
                                                <?= htmlspecialchars($product['product_name']); ?>
                                            </a>
                                        </h3>
                                        <div class="product-rating-custom">
                                            <?php
                                            $rating = $product['total_review'];
                                            $fullStars = floor($rating);
                                            $halfStar = ($rating - $fullStars) >= 0.5;
                                            for ($i = 0; $i < 5; $i++) {
                                                echo $i < $fullStars ? '<i class="fas fa-star"></i>' :
                                                    ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
                                            }
                                            ?>
                                            <span class="product-review-count">(<?= number_format($rating, 1); ?>)</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                                <?php if ($product['product_discount'] > 0): ?>
                                                    <?php
                                                    $discountedPrice = $product['product_price'] - ($product['product_price'] * ($product['product_discount']));
                                                    ?>
                                                    <span class="original-price"><s style="color: red;"><?= number_format($product['product_price'], 2); ?>
                                                            JD</s></span>
                                                    <span class="discounted-price"><?= number_format($discountedPrice, 2); ?>
                                                        JD</span>
                                                <?php else: ?>
                                                    <?= number_format($product['product_price'], 2); ?> JD
                                                <?php endif; ?>
                                            <div class="action-btn-group d-flex">
                                                <a href="cart/<?= $product['product_id'] ?>"
                                                    class="btn btn-outline-secondary btn-sm" data-tooltip="tooltip"
                                                    data-placement="top" title="Add to Cart">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                                <button class="btn btn-outline-secondary btn-sm ms-2" data-tooltip="tooltip"
                                                    data-placement="top" title="Add to Favorites" data-wishlist-button
                                                    data-product-id="<?php echo $product['product_id']; ?>">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--====== End - new arrivals ======-->


            <!--====== start - our products ======-->

            <div class="u-s-p-b-60">
                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-16">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section-title u-c-secondary u-s-m-b-12">OUR PRODUCTS</h1>
                                    <span class="section-subtitle u-c-silver">CHOOSE CATEGORY</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="filter-category-container">
                                    <div class="filter__category-wrapper">
                                        <button class="btn filter__btn filter__btn--style-1 js-checked" type="button"
                                            data-filter=".all">ALL</button>
                                    </div>
                                    <div class="filter__category-wrapper">
                                        <button class="btn filter__btn filter__btn--style-1" type="button"
                                            data-filter=".top-seller">TOP SELLERS</button>
                                    </div>
                                    <div class="filter__category-wrapper">
                                        <button class="btn filter__btn filter__btn--style-1" type="button"
                                            data-filter=".our-cake">OUR CAKE</button>
                                    </div>
                                    <div class="filter__category-wrapper">
                                        <button class="btn filter__btn filter__btn--style-1" type="button"
                                            data-filter=".sugar-free">SUGAR FREE</button>
                                    </div>
                                    <div class="filter__category-wrapper">
                                        <button class="btn filter__btn filter__btn--style-1" type="button"
                                            data-filter=".gluten-free">GLUTEN FREE</button>
                                    </div>
                                    <div class="filter__category-wrapper">
                                        <button class="btn filter__btn filter__btn--style-1" type="button"
                                            data-filter=".special-occasions">SPECIAL OCCASIONS</button>
                                    </div>
                                </div>

                                <div class="filter__grid-wrapper u-s-m-t-30">
                                    <div class="row">
                                        <!-- Display All Products -->
                                        <?php foreach ($allProducts as $product): ?>
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item all">
                                                <div class="new-product-card"> <!-- Updated class name -->
                                                    <div class="new-product-wrap"> <!-- Updated class name -->
                                                        <a class="new-aspect new-aspect--bg-grey new-aspect--square u-d-block"
                                                            href="product/<?= $product['product_id'] ?>">
                                                            <img class="new-aspect__img"
                                                                src="public/images/products/<?= $product['product_image'] ?>"
                                                                alt="<?= htmlspecialchars($product['product_name']) ?>">
                                                        </a>
                                                    </div>

                                                    <!-- Category -->
                                                    <span class="new-product-category"> <!-- Updated class name -->
                                                        <?= htmlspecialchars($product['category_name']) ?>
                                                    </span>

                                                    <!-- Product Name -->
                                                    <span class="new-product-name"> <!-- Updated class name -->
                                                        <a
                                                            href="product/<?= $product['product_id'] ?>"><?= htmlspecialchars($product['product_name']) ?></a>
                                                    </span>

                                                    <!-- Rating -->
                                                    <div class="new-product-rating"> <!-- Updated class name -->
                                                        <?php
                                                        $rating = $product['total_review'];
                                                        $fullStars = floor($rating);
                                                        $halfStar = ($rating - $fullStars) >= 0.5;
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo $i < $fullStars ? '<i class="fas fa-star"></i>' : ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
                                                        }
                                                        ?>
                                                        <span
                                                            class="new-product-review">(<?= number_format($rating, 1); ?>)</span>
                                                    </div>

                                                    <!-- Price and Action Buttons -->
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <?php if ($product['product_discount'] > 0): ?>
                                                    <?php
                                                    $discountedPrice = $product['product_price'] - ($product['product_price'] * ($product['product_discount']));
                                                    ?>
                                                    <span class="original-price"><s style="color: red;"><?= number_format($product['product_price'], 2); ?>
                                                            JD</s></span>
                                                    <span class="discounted-price"><?= number_format($discountedPrice, 2); ?>
                                                        JD</span>
                                                <?php else: ?>
                                                    <?= number_format($product['product_price'], 2); ?> JD
                                                <?php endif; ?>

                                                        <!-- Cart and Favorite Icons -->
                                                        <div class="new-action-buttons d-flex"> <!-- Updated class name -->
                                                            <a href="cart/<?= $product['product_id'] ?>"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                            <button class="btn btn-outline-secondary btn-sm ms-2"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Favorites" data-wishlist-button
                                                                data-product-id="<?php echo $product['product_id']; ?>">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>


                                        <!-- Display Top Seller Products -->
                                        <?php foreach ($topSellers as $product): ?>
                                            <div
                                                class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item top-seller">
                                                <div class="new-product-card"> <!-- Updated class name -->
                                                    <div class="new-product-wrap"> <!-- Updated class name -->
                                                        <a class="new-aspect new-aspect--bg-grey new-aspect--square u-d-block"
                                                            href="product/<?= $product['product_id'] ?>">
                                                            <img class="new-aspect__img"
                                                                src="public/images/products/<?= $product['product_image'] ?>"
                                                                alt="<?= htmlspecialchars($product['product_name']) ?>">
                                                        </a>
                                                    </div>

                                                    <!-- Category -->
                                                    <span class="new-product-category"> <!-- Updated class name -->
                                                        <?= htmlspecialchars($product['category_name']) ?>
                                                    </span>

                                                    <!-- Product Name -->
                                                    <span class="new-product-name"> <!-- Updated class name -->
                                                        <a
                                                            href="product/<?= $product['product_id'] ?>"><?= htmlspecialchars($product['product_name']) ?></a>
                                                    </span>

                                                    <!-- Rating -->
                                                    <div class="new-product-rating"> <!-- Updated class name -->
                                                        <?php
                                                        $rating = $product['total_review'];
                                                        $fullStars = floor($rating);
                                                        $halfStar = ($rating - $fullStars) >= 0.5;
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo $i < $fullStars ? '<i class="fas fa-star"></i>' : ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
                                                        }
                                                        ?>
                                                        <span
                                                            class="new-product-review">(<?= number_format($rating, 1); ?>)</span>
                                                    </div>

                                                    <!-- Price and Action Buttons -->
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <?php if ($product['product_discount'] > 0): ?>
                                                    <?php
                                                    $discountedPrice = $product['product_price'] - ($product['product_price'] * ($product['product_discount']));
                                                    ?>
                                                    <span class="original-price"><s style="color: red;"><?= number_format($product['product_price'], 2); ?>
                                                            JD</s></span>
                                                    <span class="discounted-price"><?= number_format($discountedPrice, 2); ?>
                                                        JD</span>
                                                <?php else: ?>
                                                    <?= number_format($product['product_price'], 2); ?> JD
                                                <?php endif; ?>

                                                        <!-- Cart and Favorite Icons -->
                                                        <div class="new-action-buttons d-flex"> <!-- Updated class name -->
                                                            <a href="cart/<?= $product['product_id'] ?>"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                            <button class="btn btn-outline-secondary btn-sm ms-2"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Favorites">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <!-- Similarly, display other categories -->
                                        <!-- OUR CAKE -->
                                        <?php foreach ($ourCake as $product): ?>
                                            <div
                                                class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item our-cake">
                                                <div class="new-product-card"> <!-- Updated class name -->
                                                    <div class="new-product-wrap"> <!-- Updated class name -->
                                                        <a class="new-aspect new-aspect--bg-grey new-aspect--square u-d-block"
                                                            href="product/<?= $product['product_id'] ?>">
                                                            <img class="new-aspect__img"
                                                                src="public/images/products/<?= $product['product_image'] ?>"
                                                                alt="<?= htmlspecialchars($product['product_name']) ?>">
                                                        </a>
                                                    </div>

                                                    <!-- Category -->
                                                    <span class="new-product-category"> <!-- Updated class name -->
                                                        <?= htmlspecialchars($product['category_name']) ?>
                                                    </span>

                                                    <!-- Product Name -->
                                                    <span class="new-product-name"> <!-- Updated class name -->
                                                        <a
                                                            href="product/<?= $product['product_id'] ?>"><?= htmlspecialchars($product['product_name']) ?></a>
                                                    </span>

                                                    <!-- Rating -->
                                                    <div class="new-product-rating"> <!-- Updated class name -->
                                                        <?php
                                                        $rating = $product['total_review'];
                                                        $fullStars = floor($rating);
                                                        $halfStar = ($rating - $fullStars) >= 0.5;
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo $i < $fullStars ? '<i class="fas fa-star"></i>' : ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
                                                        }
                                                        ?>
                                                        <span
                                                            class="new-product-review">(<?= number_format($rating, 1); ?>)</span>
                                                    </div>

                                                    <!-- Price and Action Buttons -->
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <?php if ($product['product_discount'] > 0): ?>
                                                    <?php
                                                    $discountedPrice = $product['product_price'] - ($product['product_price'] * ($product['product_discount']));
                                                    ?>
                                                    <span class="original-price"><s style="color: red;"><?= number_format($product['product_price'], 2); ?>
                                                            JD</s></span>
                                                    <span class="discounted-price"><?= number_format($discountedPrice, 2); ?>
                                                        JD</span>
                                                <?php else: ?>
                                                    <?= number_format($product['product_price'], 2); ?> JD
                                                <?php endif; ?>

                                                        <!-- Cart and Favorite Icons -->
                                                        <div class="new-action-buttons d-flex"> <!-- Updated class name -->
                                                            <a href="cart/<?= $product['product_id'] ?>"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                            <button class="btn btn-outline-secondary btn-sm ms-2"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Favorites">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <!-- SUGAR FREE -->
                                        <?php foreach ($sugarFree as $product): ?>
                                            <div
                                                class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item sugar-free">
                                                <div class="new-product-card"> <!-- Updated class name -->
                                                    <div class="new-product-wrap"> <!-- Updated class name -->
                                                        <a class="new-aspect new-aspect--bg-grey new-aspect--square u-d-block"
                                                            href="product/<?= $product['product_id'] ?>">
                                                            <img class="new-aspect__img"
                                                                src="public/images/products/<?= $product['product_image'] ?>"
                                                                alt="<?= htmlspecialchars($product['product_name']) ?>">
                                                        </a>
                                                    </div>

                                                    <!-- Category -->
                                                    <span class="new-product-category"> <!-- Updated class name -->
                                                        <?= htmlspecialchars($product['category_name']) ?>
                                                    </span>

                                                    <!-- Product Name -->
                                                    <span class="new-product-name"> <!-- Updated class name -->
                                                        <a
                                                            href="product/<?= $product['product_id'] ?>"><?= htmlspecialchars($product['product_name']) ?></a>
                                                    </span>

                                                    <!-- Rating -->
                                                    <div class="new-product-rating"> <!-- Updated class name -->
                                                        <?php
                                                        $rating = $product['total_review'];
                                                        $fullStars = floor($rating);
                                                        $halfStar = ($rating - $fullStars) >= 0.5;
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo $i < $fullStars ? '<i class="fas fa-star"></i>' : ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
                                                        }
                                                        ?>
                                                        <span
                                                            class="new-product-review">(<?= number_format($rating, 1); ?>)</span>
                                                    </div>

                                                    <!-- Price and Action Buttons -->
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <?php if ($product['product_discount'] > 0): ?>
                                                    <?php
                                                    $discountedPrice = $product['product_price'] - ($product['product_price'] * ($product['product_discount']));
                                                    ?>
                                                    <span class="original-price"><s style="color: red;"><?= number_format($product['product_price'], 2); ?>
                                                            JD</s></span>
                                                    <span class="discounted-price"><?= number_format($discountedPrice, 2); ?>
                                                        JD</span>
                                                <?php else: ?>
                                                    <?= number_format($product['product_price'], 2); ?> JD
                                                <?php endif; ?>

                                                        <!-- Cart and Favorite Icons -->
                                                        <div class="new-action-buttons d-flex"> <!-- Updated class name -->
                                                            <a href="cart/<?= $product['product_id'] ?>"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                            <button class="btn btn-outline-secondary btn-sm ms-2"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Favorites">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <!-- GLUTEN FREE -->
                                        <?php foreach ($glutenFree as $product): ?>
                                            <div
                                                class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item gluten-free">
                                                <div class="new-product-card"> <!-- Updated class name -->
                                                    <div class="new-product-wrap"> <!-- Updated class name -->
                                                        <a class="new-aspect new-aspect--bg-grey new-aspect--square u-d-block"
                                                            href="product/<?= $product['product_id'] ?>">
                                                            <img class="new-aspect__img"
                                                                src="public/images/products/<?= $product['product_image'] ?>"
                                                                alt="<?= htmlspecialchars($product['product_name']) ?>">
                                                        </a>
                                                    </div>

                                                    <!-- Category -->
                                                    <span class="new-product-category"> <!-- Updated class name -->
                                                        <?= htmlspecialchars($product['category_name']) ?>
                                                    </span>

                                                    <!-- Product Name -->
                                                    <span class="new-product-name"> <!-- Updated class name -->
                                                        <a
                                                            href="product/<?= $product['product_id'] ?>"><?= htmlspecialchars($product['product_name']) ?></a>
                                                    </span>

                                                    <!-- Rating -->
                                                    <div class="new-product-rating"> <!-- Updated class name -->
                                                        <?php
                                                        $rating = $product['total_review'];
                                                        $fullStars = floor($rating);
                                                        $halfStar = ($rating - $fullStars) >= 0.5;
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo $i < $fullStars ? '<i class="fas fa-star"></i>' : ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
                                                        }
                                                        ?>
                                                        <span
                                                            class="new-product-review">(<?= number_format($rating, 1); ?>)</span>
                                                    </div>

                                                    <!-- Price and Action Buttons -->
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <?php if ($product['product_discount'] > 0): ?>
                                                    <?php
                                                    $discountedPrice = $product['product_price'] - ($product['product_price'] * ($product['product_discount']));
                                                    ?>
                                                    <span class="original-price"><s style="color: red;"><?= number_format($product['product_price'], 2); ?>
                                                            JD</s></span>
                                                    <span class="discounted-price"><?= number_format($discountedPrice, 2); ?>
                                                        JD</span>
                                                <?php else: ?>
                                                    <?= number_format($product['product_price'], 2); ?> JD
                                                <?php endif; ?>

                                                        <!-- Cart and Favorite Icons -->
                                                        <div class="new-action-buttons d-flex"> <!-- Updated class name -->
                                                            <a href="cart/<?= $product['product_id'] ?>"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                            <button class="btn btn-outline-secondary btn-sm ms-2"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Favorites">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <!-- SPECIAL OCCASIONS -->
                                        <?php foreach ($specialOccasions as $product): ?>
                                            <div
                                                class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item spacial-occasions">
                                                <div class="new-product-card"> <!-- Updated class name -->
                                                    <div class="new-product-wrap"> <!-- Updated class name -->
                                                        <a class="new-aspect new-aspect--bg-grey new-aspect--square u-d-block"
                                                            href="product/<?= $product['product_id'] ?>">
                                                            <img class="new-aspect__img"
                                                                src="public/images/products/<?= $product['product_image'] ?>"
                                                                alt="<?= htmlspecialchars($product['product_name']) ?>">
                                                        </a>
                                                    </div>

                                                    <!-- Category -->
                                                    <span class="new-product-category"> <!-- Updated class name -->
                                                        <?= htmlspecialchars($product['category_name']) ?>
                                                    </span>

                                                    <!-- Product Name -->
                                                    <span class="new-product-name"> <!-- Updated class name -->
                                                        <a
                                                            href="product/<?= $product['product_id'] ?>"><?= htmlspecialchars($product['product_name']) ?></a>
                                                    </span>

                                                    <!-- Rating -->
                                                    <div class="new-product-rating"> <!-- Updated class name -->
                                                        <?php
                                                        $rating = $product['total_review'];
                                                        $fullStars = floor($rating);
                                                        $halfStar = ($rating - $fullStars) >= 0.5;
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo $i < $fullStars ? '<i class="fas fa-star"></i>' : ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
                                                        }
                                                        ?>
                                                        <span
                                                            class="new-product-review">(<?= number_format($rating, 1); ?>)</span>
                                                    </div>

                                                    <!-- Price and Action Buttons -->
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <?php if ($product['product_discount'] > 0): ?>
                                                    <?php
                                                    $discountedPrice = $product['product_price'] - ($product['product_price'] * ($product['product_discount']));
                                                    ?>
                                                    <span class="original-price"><s style="color: red;"><?= number_format($product['product_price'], 2); ?>
                                                            JD</s></span>
                                                    <span class="discounted-price"><?= number_format($discountedPrice, 2); ?>
                                                        JD</span>
                                                <?php else: ?>
                                                    <?= number_format($product['product_price'], 2); ?> JD
                                                <?php endif; ?>

                                                        <!-- Cart and Favorite Icons -->
                                                        <div class="new-action-buttons d-flex"> <!-- Updated class name -->
                                                            <a href="cart/<?= $product['product_id'] ?>"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                            <button class="btn btn-outline-secondary btn-sm ms-2"
                                                                data-tooltip="tooltip" data-placement="top"
                                                                title="Add to Favorites">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ====== End - our products ====== -->

            <!--====== deal of the day section ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="section__heading text-center u-c-secondary u-s-m-b-30">DEAL OF THE DAY</h1>
                            <!-- Section heading -->
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($dealOfTheDay as $product): ?>
                            <div class="col-lg-6 col-md-6 mb-4"> <!-- Added Bootstrap margin utility class -->
                                <div class="card border-light rounded shadow-lg h-100">
                                    <!-- Using Bootstrap card classes -->
                                    <a href="product/<?= $product['product_id'] ?>" class="text-decoration-none">
                                        <img src="public/images/products/<?= $product['product_image'] ?>"
                                            alt="<?= htmlspecialchars($product['product_name']) ?>" class="card-img-top">
                                    </a>
                                    <div class="card-body text-center"> <!-- Centered text in the card body -->
                                        <span
                                            class="badge bg-secondary mb-2"><?= htmlspecialchars($product['category_name']) ?></span>
                                        <h2 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h2>
                                        <div class="new-product-rating">
                                            <?php
                                            $rating = $product['total_review'];
                                            $fullStars = floor($rating);
                                            $halfStar = ($rating - $fullStars) >= 0.5;
                                            for ($i = 0; $i < 5; $i++) {
                                                echo $i < $fullStars ? '<i class="fas fa-star"></i>' : ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
                                            }
                                            ?>
                                            <span class="product-review">(<?= number_format($rating, 1); ?>)</span>
                                        </div>
                                        <div class="product-o__price">
                                            <span
                                                class="text-danger fw-bold"><?= number_format($product['discounted_price'], 2) ?>
                                                JD</span>
                                            <span
                                                class="text-muted text-decoration-line-through"><?= number_format($product['product_price'], 2) ?>
                                                JD</span>
                                            <span class="new-action-buttons d-flex">
                                                <a href="cart/<?= $product['product_id'] ?>"
                                                    class="btn btn-outline-secondary btn-sm" data-tooltip="tooltip"
                                                    data-placement="top" title="Add to Cart">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                                <button class="btn btn-outline-secondary btn-sm ms-2" data-tooltip="tooltip"
                                                    data-placement="top" data-wishlist-button
                                                    data-product-id="<?php echo $product['product_id']; ?>"
                                                    title="Add to Favorites">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="special-countdown mb-3"><span> The Deal Ends On </span>
                            <div class="countdown countdown--style-special"
                                data-end-time="<?= strtotime('+1 days') * 1000 ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--====== End - deal of the day section ======-->



            <!--====== Section 11 ======-->
            <!-- views/testimonials.php -->
            <!--====== Section 11 ======-->
            <div class="u-s-p-b-90 u-s-m-b-30">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-46">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary u-s-m-b-12">CLIENTS FEEDBACK</h1>
                                    <span class="section__span u-c-silver">WHAT OUR CLIENTS SAY</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">

                        <!--====== Testimonial Slider ======-->
                        <div class="slider-fouc">
                            <div class="owl-carousel owl-theme owl-loaded owl-drag" id="testimonial-slider">
                                <?php foreach ($testimonials as $testimonial): ?>
                                    <div class="testimonial">
                                        <div class="testimonial__img-wrap">
                                            <img class="testimonial__img"
                                                src="public/images/testimonials/<?= $testimonial['image'] ?>" alt="">
                                        </div>
                                        <div class="testimonial__content-wrap">
                                            <span class="testimonial__double-quote"><i
                                                    class="fas fa-quote-right"></i></span>
                                            <blockquote class="testimonial__block-quote">
                                                <p><?= htmlspecialchars($testimonial['testimonial_text']) ?></p>
                                            </blockquote>
                                            <span class="testimonial__author"><?= htmlspecialchars($testimonial['name']) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!--====== End - Testimonial Slider ======-->
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>

            <!--====== End - Section 11 ======-->

        </div>
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
        <?php
        include_once 'views/partials/footer.php';
        ?>
        <!--====== End - Main Footer ======-->
    </div>
    <!--====== End - Main App ======-->


    <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->
    <script>
        window.ga = function () {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')
    </script>

    <!--====== Vendor Js ======-->
    <script src="public/js/vendor.js"></script>

    <!-- ====== jQuery Shopnav plugin ====== -->
    <script src="public/js/jquery.shopnav.js"></script>

    <!--====== App ======-->
    <script src="public/js/app.js"></script>

    <!--====== Add to Favorites ======-->

    <script src="public/js/AddtoFavorites.js"></script>

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
    <script>
        var myCarousel = document.querySelector('#heroCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 3000, // Slide interval in milliseconds
            ride: 'carousel'
        });
    </script>
    <script>
        $(document).ready(function () {
            // Automatically click the "ALL" filter button on page load
            $('.filter__btn.js-checked').trigger('click');
        });
    </script>
    <script>
        // JavaScript Countdown Timer
        document.querySelectorAll('.countdown').forEach(function (countdown) {
            const endTime = parseInt(countdown.getAttribute('data-end-time'));
            function updateCountdown() {
                const now = new Date().getTime();
                const distance = endTime - now;
                if (distance < 0) {
                    countdown.innerHTML = "Expired";
                    return;
                }
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                countdown.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            }
            setInterval(updateCountdown, 1000);
        });
    </script>
    <script>
        // Set the end time for the countdown in milliseconds
        let endTime = localStorage.getItem('countdownEndTime');

        // If no end time is stored, set it to 24 hours from now and save it
        if (!endTime) {
            endTime = new Date().getTime() + 24 * 60 * 60 * 1000;
            localStorage.setItem('countdownEndTime', endTime);
        }

        const countdownElement = document.querySelector('.countdown--style-special');

        // Function to update countdown display
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance < 0) {
                countdownElement.innerHTML = "Deal Expired";
                localStorage.removeItem('countdownEndTime'); // Clear storage after expiration
                return;
            }

            // Calculate hours, minutes, and seconds
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `
        <span>${hours}h</span> : 
        <span>${minutes}m</span> : 
        <span>${seconds}s</span>
    `;
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);

    </script>
    <script>
        $(document).ready(function () {
            $("#testimonial-slider").owlCarousel({
                $('#testimonial-slider').owlCarousel({
                    items: 1,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    smartSpeed: 600,
                    margin: 30,
                    dots: true
                });
            });
        });
    </script>
    <script>
        // Sample product data (you may fetch this from your server instead)
        const products = [
            { name: "Chocolate Cake", id: 1 },
            { name: "Vanilla Cake", id: 2 },
            { name: "Red Velvet Cake", id: 3 },
            { name: "Carrot Cake", id: 4 },
            // Add more products as needed
        ];

        // Function to handle search
        function handleSearch(event) {
            event.preventDefault(); // Prevent the form from submitting
            const query = document.getElementById('search-input').value.toLowerCase();

            // Find the first matching product
            const product = products.find(product => product.name.toLowerCase().includes(query));

            if (product) {
                // Redirect to the product details page
                window.location.href = `product-details.php?id=${product.id}`;
            } else {
                alert("No products found. Please try a different search.");
            }
        }
    </script>

</body>

</html>