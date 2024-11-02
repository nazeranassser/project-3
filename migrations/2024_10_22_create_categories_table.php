<?php

class CreateCategoriesTable
{
    public function up()
    {
        return "CREATE TABLE IF NOT EXISTS `categories` (
            `category_id` int(11) NOT NULL AUTO_INCREMENT,
            `category_name` varchar(255) NOT NULL,
            PRIMARY KEY (`category_ID`),
            `category_image` varchar(255) NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
            )";
    }

    public function down()
    {
        return "DROP TABLE IF EXISTS `categories`";
    }
}