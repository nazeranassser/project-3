<?php
require  __DIR__ .'/app/controllers/AdminsControllers.php';
// require  __DIR__ .'/app/controllers/CartsControllers.php';
// require  __DIR__ .'/app/controllers/CustomersControllers.php';
// require  __DIR__ .'/app/controllers/ProductsControllers.php';
// require  __DIR__ .'/app/controllers/CouponsControllers.php';
// require  __DIR__ .'/app/controllers/OrdersControllers.php';

require 'vendor/autoload.php';
// require_once __DIR__ . '/../';

use App\Router;

$router = new Router();

// Add routes

/* -----------------------------------Products Router---------------------------------- */

$router->add('', ['controller' => 'Products', 'action' => 'showHomePage']);
$router->add('update_product/{id:\d+}', ['controller' => 'Products', 'action' => 'edit']);//admins-controllers->update_admin()
$router->add('product/update', ['controller' => 'Products', 'action' => 'update']);//ProductsControllers->update()
$router->add('product-add', ['controller' => 'Products', 'action' => 'add']);//admins-controllers->update_admin()
$router->add('create-product', ['controller' => 'Products', 'action' => 'addProduct']);//admins-controllers->update_admin()
$router->add('product-category-filter', ['controller' => 'Products', 'action' => 'index']);
$router->add('product/{id:\d+}', ['controller' => 'Products', 'action' => 'viewProduct']);
$router->add('allProducts', ['controller' => 'Products', 'action' => 'showProducts']);  
$router->add('products', ['controller' => 'Products', 'action' => 'filter']);
$router->add('reviews', ['controller' => 'Products', 'action' => 'viewProduct']);
$router->add('products/delete/{id:\d+}', ['controller' => 'Products', 'action' => 'delete']);
// $router->add('products/update/{id:\d+}', ['controller' => 'Products', 'action' => 'update']);
// $router->add('products', ['controller' => 'Products', 'action' => 'index']);//admins-controllers->update_admin()


/* -----------------------------------Carts Router---------------------------------- */

$router->add('clearCart', ['controller' => 'Carts', 'action' => 'clearCart']);
$router->add('cart', ['controller' => 'Carts', 'action' => 'index']);
$router->add('cart/{id:\d+}', ['controller' => 'Carts', 'action' => 'addToCart']);
$router->add('removeFromCart/{id:\d+}', ['controller' => 'Carts', 'action' => 'removeFromCart']);
$router->add('checkout', ['controller' => 'Carts', 'action' => 'checkout']);
$router->add('applyCoupon', ['controller' => 'Coupons', 'action' => 'applyCoupon']);
$router->add('removeCoupon', ['controller' => 'Coupons', 'action' => 'removeCoupon']);
$router->add('placeOrder', ['controller' => 'Carts', 'action' => 'placeOrder']);

/* -----------------------------------Orders Router---------------------------------- */

$router->add('orders', ['controller' => 'Orders', 'action' => 'get']);
$router->add('orderDetails', ['controller' => 'Orders', 'action' => 'orderDetails']);
$router->add('order-status', ['controller' => 'Orders', 'action' => 'orderStatus']);


/* -----------------------------------Wishlist Router---------------------------------- */
// Route to show wishlist items
$router->add('wishlist', ['controller' => 'Wishlist', 'action' => 'show']);
// Route to add item to wishlist
$router->add('wishlist/store', ['controller' => 'Wishlist', 'action' => 'store']);
// Route to remove item from wishlist
$router->add('wishlist/delete', ['controller' => 'Wishlist', 'action' => 'delete']);
// Route to check if product is in wishlist (optional, for AJAX checking)
$router->add('wishlist/check', ['controller' => 'Wishlist', 'action' => 'check']);


/* -----------------------------------Admins Router---------------------------------- */
$router->add('dash', ['controller' => 'Admins', 'action' => 'index']);// dashboard-admin.php "/"
// $router->add('admins', ['controller' => 'Admins', 'action' => 'get']);// dash-admins.php
$router->add('add-admin', ['controller' => 'Admins', 'action' => 'add']);// dash-admin-add.php
$router->add('edit-admin', ['controller' => 'Admins', 'action' => 'edit']);// dash-admin-edit.php
$router->add('register', ['controller' => 'Admins', 'action' => 'register']);//admins-controllers->register()
$router->add('update_admin', ['controller' => 'Admins', 'action' => 'update']);//admins-controllers->update_admin()
$router->add('admin/login', ['controller' => 'Admins', 'action' => 'index']);
$router->add('admin/login', ['controller' => 'Admins', 'action' => 'loginPage']);
$router->add('login/admin', ['controller' => 'Admins', 'action' => 'login']);
$router->add('edit-admin/{id:\d+}', ['controller' => 'Admins', 'action' => 'getById']);
$router->add('delete-admin/{id:\d+}', ['controller' => 'Admins', 'action' => 'delete']);
$router->add('admins', ['controller' => 'Admins', 'action' => 'filter']);


/* -----------------------------------Customers Router---------------------------------- */

$router->add('admin/customers', ['controller' => 'customers', 'action' => 'get']);
$router->add('profile-edit', ['controller' => 'Customers', 'action' => 'editPage']);
$router->add('profile-update', ['controller' => 'Customers', 'action' => 'update']);//admins-controllers->update_admin()
$router->add('login-add', ['controller' => 'Customers', 'action' => 'login']);
$router->add('login', ['controller' => 'Customers', 'action' => 'loginPage']);
$router->add('signup', ['controller' => 'Customers', 'action' => 'signupPage']);
$router->add('sign-out', ['controller' => 'Customers', 'action' => 'logout']);
$router->add('customer/delete/{id:\d+}', ['controller' => 'Customers', 'action' => 'delete']);
$router->add('profile-main', ['controller' => 'Customers', 'action' => 'getById']);
$router->add('profile-order', ['controller' => 'Customers', 'action' => 'getById1']);
$router->add('signup-action', ['controller' => 'Customers', 'action' => 'register']);
$router->add('about-us', ['controller' => 'customers', 'action' => 'about']);
$router->add('orders-detal/{id:\d+}', ['controller' => 'customers', 'action' => 'viewOrderDetails']);
$router->add('customer-details/{id:\d+}', ['controller' => 'customers', 'action' => 'customerDetails']);//admins-controllers->update_admin()
$router->add('orders-detail/{id:\d+}', ['controller' => 'customers', 'action' => 'viewOrderDetails']);




/* -----------------------------------Coupons Router---------------------------------- */

$router->add('coupons', ['controller' => 'Coupons', 'action' => 'get']);
$router->add('coupons-add', ['controller' => 'Coupons', 'action' => 'addPage']);
$router->add('new_coupon', ['controller' => 'Coupons', 'action' => 'add']);
$router->add('coupon-delete', ['controller' => 'Coupons', 'action' => 'delete']);
$router->add('coupon-edit/{id:\d+}', ['controller' => 'Coupons', 'action' => 'editPage']);
$router->add('coupons/update/{id:\d+}', ['controller' => 'Coupons', 'action' => 'updateCoupon']);


/* -----------------------------------Reviews Router---------------------------------- */

$router->add('submitReview', ['controller' => 'Reviews', 'action' => 'submitReview']);



// Dispatch the request
$url = trim($_SERVER['REQUEST_URI'], '/'); // Trim leading and trailing slashes
$url2 = explode('=',$_SERVER['REQUEST_URI']);
if(isset($url2[1])){
    $url3 = explode('?',$_SERVER['REQUEST_URI']);
    $url = trim($url3[0], '/'); 
    // var_dump($url3);
    // die();
}
// Dispatch the request
// var_dump($url);
// die();
// $url4 = getAssetPaths($url);
// var_dump($url4);
// die();
$router->dispatch($url);
function getAssetPaths($rootDir) {
    $assetPaths = [];

    // Scan the directory for files and subdirectories
    $files = scandir($rootDir);

    foreach ($files as $file) {
        // Ignore current and parent directory links
        if ($file !== '.' && $file !== '..') {
            $fullPath = $rootDir . '/' . $file;

            if (is_file($fullPath)) {
                // Add relative path
                $assetPaths[] = $file;
            } elseif (is_dir($fullPath)) {
                // Recursively get paths from subdirectories
                $assetPaths = array_merge($assetPaths, getAssetPaths($fullPath));
            }
        }
    }

    return $assetPaths;
}

?>