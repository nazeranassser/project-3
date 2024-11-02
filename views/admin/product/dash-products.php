<!--====== Main Header ======-->
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

                                        <a href="index.php">Home</a></li>
                                    <li class="is-marked">

                                        <a>Admins</a></li>
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
                                    <div>

                                        <a class="dash__custom-link btn--e-brand-b-2" href="product-add"><i class="fas fa-plus u-s-m-r-8"></i>

                                            <span>Add New Product</span></a></div>
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
                                        <div class="dash__pad-2" style="display:flex;justify-content: space-between;">
                                            <div class="dash__address-header">
                                                <h1 class="dash__h1">Products</h1>
                                            </div>
                                            <div class="dash__filter">
                                                <form method="GET" action="/products" id="categoryForm">
                                                    <select class="select-box select-box--primary-style" style="border-radius:6px" name="id" id="categoryFilter" onchange="this.form.submit()">
                                                        <option value="all">All Categories</option>
                                                        <?php foreach ($categories as $category): ?>
                                                            
                                                            <option value="<?= $category['category_id'] ?>" 
                                                                <?= isset($_GET['id']) && $_GET['id'] == $category['category_id'] ? 'selected' : '' ?>>
                                                                <?= $category['category_name']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="dash__table">
                                            <table class="dash__table">
                                                <thead>
                                                    <tr>
                                                        <th>Product Image</th>
                                                        <th>Product Name</th>
                                                        <th>Product Price</th>
                                                        <th>Product Quantity</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php

                                                  foreach($products as $product){
                                                    // var_dump($product);
                                                    echo "  <tr>
                                                    
                                                         <form method='POST' action='/update_product/".$product['product_id']."'>
                                                            <th><a href='/update_product/".$product['product_id']."'><div  class='description__img-wrap'>
                                                            <img class='u-img-fluid' style='border-radius: 10000px;width: 90px;height: 90px;' src='".$product['product_image']."' alt=''></div></a></th>
                                                            <th>".$product['product_name']."</th>
                                                            <th>".$product['product_price']."</th>
                                                            <th>".$product['product_quantity']."</th>
                                                            <th><div style='display: flex; align-items: center;'>
                                                            <button type='submit' class='address-book-edit btn--e-transparent-platinum-b-2' style='margin-right:4px;'>Edit</button></form>
                                                            <form method='POST' action='/products/delete/".$product['product_id']."'>
                                                            <input type='hidden' value='".$product['product_id']."' name='delete_product''>
                                                            <button type='submit' class='address-book-edit btn btn--e-brand-b-2'>Delete</button></form></div></th>
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

        <script>
    // function redirectToCategory() {
    //     const selectElement = document.getElementById("categoryFilter");
    //     const selectedCategoryId = selectElement.value;
    //     if (selectedCategoryId) {
    //         // Redirect to the dynamic category route
    //         window.location.href = `products/${selectedCategoryId}`;
    //         <?php
    //         // header("location:`products/${selectedCategoryId}`");
    //         ?>
    //     } else {
    //         // Redirect to show all categories if no specific category is selected
    //         window.location.href = "products";
    //     }
    // }
</script>
        <!--====== Main Footer ======-->
        <?php include('views/partials/footer_admin.php');?>
