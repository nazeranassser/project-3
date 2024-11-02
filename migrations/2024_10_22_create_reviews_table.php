<?php

class CreateReviewsTable
{
    public function up()
    {
        return "CREATE TABLE IF NOT EXISTS `reviews` (
            `review_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `product_id` int(11) NOT NULL,
            `customer_id` int(11) NOT NULL,
            `review_text` text NOT NULL,
            `review_rating` DECIMAL(2,1) CHECK (review_rating BETWEEN 0 AND 5),
            `review_image` varchar(255) NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            foreign key (product_id) references products(product_id),
            foreign key (customer_id) references customers(customer_id)
            )";
    }
    public function down()
    {
        return "DROP TABLE IF EXISTS `reviews`";
    }
}   