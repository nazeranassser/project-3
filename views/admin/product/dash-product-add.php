<!--====== Main Header ======-->
<?php include('views/partials/header_admin.php');?>

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

                                        <a href="dash-address-add.html">My Account</a></li>
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
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">Add new Product</h1>

                                            <span class="dash__text u-s-m-b-30"></span>
                                            <form id="productForm" enctype="multipart/form-data" class="dash-address-manipulation" method='POST'  action='create-product'>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">
                                                        <label class="gl-label" for="product-name">Product Name *</label>
                                                        <input class="input-text input-text--primary-style" type="text" name='product_name' id="product-name" placeholder="Product Name" required>
                                                    </div>
                                                        <div class="u-s-m-b-30">

                                                            <!--====== Select Box ======-->
                                                            
                                                            <label class="gl-label" for="categories">Categories *</label>
                                                            <select name='category_id' class="select-box select-box--primary-style" id="categories" required>
                                                                <option value="">Choose Category</option>
                                                                <?php
                                                                   foreach($categories as $category) {
                                                                    echo "<option value='".$category['category_id']."'>".$category['category_name']."</option>";
                                                                   }
                                                                ?>
                                                                <!-- <a href='dash-orders.php'><option>Add Category</option></a> -->
                                                            </select>
                                                            <!--====== End - Select Box ======-->
                                                        </div>
                                                    </div>
                                                <div>
                                                <label class="gl-label" for="product_description-">Product Description *</label>
                                                <textarea class='input-text--primary-style' style='width: 100%;padding:10px; ' id="product_description" name="product_description" rows="4" required></textarea>
                                                </div>
                                                <div class="gl-inline">
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="price">Price *</label>

                                                        <input class="input-text input-text--primary-style" name='product_price' step="0.01" type="number" id="price" required></div>
                                                    <div class="u-s-m-b-30">

                                                        <label class="gl-label" for="quantity">Quantity *</label>

                                                        <input class="input-text input-text--primary-style" name='product_quantity' type="number" id="quantity" placeholder="House Name and Street" required></div>
                                                </div>
                                                <div class="gl-inline" style='display: flex;justify-content:center; padding-left:10px;padding-bottom:10px ;'>
                                                <div class="upload-container">
                                                    <div id="drop-area" class="drop-area">
                                                        <p>Drag & Drop your images here or <span id="browse">Browse</span></p>
                                                        <input type="file" id="fileElem" name="image" accept="image/*" style="display:none" required>
                                        
                                                    </div>
                                            
                                                    <!-- Preview and confirmation buttons -->
                                                    <div id="preview-container" class="preview-container">
                                                        <img id="preview-image" alt="Image Preview">
                                                        <div>
                                                            <a class="btn-cancel btn btn--e-brand-b-2" id="cancel-btn">Delete Image</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <button class="btn btn--e-brand-b-2" type="submit">SAVE</button>
                                            </form>
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
        <?php require('views/partials/footer_admin.php');?>