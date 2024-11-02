<?php

class CreateOrdersTable
{

    public function up()
    {

        return "CREATE TABLE IF NOT EXISTS `orders` (
            `order_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `customer_id` int(11) NOT NULL,
            `coupon_id` int(11) NOT NULL,
            `order_total_amount` float NOT NULL,
            `order_total_amount_after` float NOT NULL,
            `order_status` enum('processing','shipped','delivered','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            `delivery_address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            foreign KEY (customer_id) references customers (`customer_id`),
            foreign KEY (coupon_id) references coupons (`coupon_id`)
            )";
    }
}