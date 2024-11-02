<?php

class CreateTestimonialsTable {

    public function up() {
        return "CREATE TABLE IF NOT EXISTS `testimonials` (
            `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `testimonial_text` text NOT NULL,
            `image` varchar(255) NOT NULL,
            PRIMARY KEY (`testimonial_id`),
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL
            )";   
    }

    public function down() {
        return "DROP TABLE IF EXISTS `admins`";
    }
}