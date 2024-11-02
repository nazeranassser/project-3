<?php

class CreateOrderProductsTable
{
    public function up()
    {
        return "CREATE TABLE IF NOT EXISTS `order_products` (
            `order_product_id` int(11) NOT NULL AUTO_INCREMENT,
            `order_id` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            `quantity` int(11) NOT NULL,
            `price` decimal(10,2) NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`order_product_id`),
            foreign key (order_id) references orders(order_id),
            foreign key (product_id) references products(product_id)
            )";
    }

    public function down()
    {
        return "DROP TABLE IF EXISTS `order_products`";
    }
}