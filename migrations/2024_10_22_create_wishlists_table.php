<?php

class CreateWishlistsTable 
{

    public function up()
    {

        return "CREATE TABLE IF NOT EXISTS `wishlists` (
            `wishlist_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `customer_id` int NOT NULL,
            `product_id` int NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            foreign key (customer_id) references customers(customer_id),
            foreign key (product_id) references products(product_id)
            )";
    }
}