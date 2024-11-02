<?php 

class CreateProductsTable{

    public function up()
    {

        return "CREATE TABLE IF NOT EXISTS `products` (
            `product_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `product_name` varchar(255) NOT NULL,
            `product_description` text NOT NULL,
            `product_price` decimal(10,2) NOT NULL,
            `product_image` varchar(255) NOT NULL,
            `category_id` int(11) NOT NULL,
            `product_quantity` int(11) NOT NULL,
            `total_review` int(11) NOT NULL,
            `product_discount` float(11) NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            foreign key (category_id) references categories(category_id)
            )";
    }
}