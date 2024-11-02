<?php

class CreateCustomersTable
{
    public function up()
    {
        return "CREATE TABLE IF NOT EXISTS `customers` (
            `customer_id` int(11) NOT NULL AUTO_INCREMENT,
            `customer_name` varchar(255) NOT NULL,
            `customer_email` varchar(255) NOT NULL,
            `customer_password` varchar(255) NOT NULL,
            `customer_address1` varchar(255) NOT NULL,
            `customer_address2` varchar(255) NULL,
            `customer_phone` varchar(255) NOT NULL,
            `customer_image` varchar(255) NOT NULL,
            PRIMARY KEY (`customer_id`),
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
            )";
    }   

    public function down()
    {
        return "DROP TABLE IF EXISTS `customers`";
    }
}