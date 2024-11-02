    <?php require 'views/partials/header.php'; ?>

    <div class="container"> 
        <!-- Search Filters -->
        <div class="filters">
    <form method="GET" action="">
        <input type="text" style="width:100%" name="search" placeholder="Search for a product..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        <div style="width:100%">
        <select style="width:50%" name="category">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category['category_name']); ?>"
                        <?php echo (isset($_GET['category']) && $_GET['category'] == $category['category_name']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['category_name']); ?>
                    (<?php echo $category['product_count']; ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <select style="width:49%" name="sort">
            <option value="">Sort By</option>
            <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : ''; ?>>Price: Low to High</option>
            <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : ''; ?>>Price: High to Low</option>
            <option value="rating" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'rating') ? 'selected' : ''; ?>>Rating</option>
        </select>
            </div>
        <button type="submit" class="btn">Apply Filters</button>
    </form>
</div>
    <!-- Loop through all products -->
    <div class="u-s-p-b-60">

    <div class="section__content">
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
                                            <a
                                                href="product/<?= $product['product_id']; ?>"><?= htmlspecialchars($product['product_name']); ?></a>
                                        </h3>
                                        <div class="product-rating-custom">
                                            <?php
                                            $rating = $product['total_review'];
                                            $fullStars = floor($rating);
                                            $halfStar = ($rating - $fullStars) >= 0.5;
                                            for ($i = 0; $i < 5; $i++) {
                                                echo $i < $fullStars ? '<i class="fas fa-star"></i>' : ($halfStar && $i == $fullStars ? '<i class="fas fa-star-half-alt"></i>' : '<i class="far fa-star"></i>');
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
                                                <button class="btn btn-outline-secondary btn-sm ms-2"
                                                 data-tooltip="tooltip"
                                                  data-placement="top"
                                                 title="Add to Favorites"
                                                  data-wishlist-button
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


    </div>

    <?php require 'views/partials/footer.php'; ?>

    <!--====== Add to Favorites ======-->

    <script src="public/js/AddtoFavorites.js"></script>

</body>
</html>
