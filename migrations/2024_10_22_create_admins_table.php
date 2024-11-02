<?php

class CreateAdminsTable {

    public function up() {
        return "CREATE TABLE IF NOT EXISTS `admins` (
    `admin_id` int(11) NOT NULL AUTO_INCREMENT,
    `admin_name` varchar(255) NOT NULL,
    `admin_email` varchar(255) NOT NULL,
    `admin_password` varchar(255) NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT 0,
    `is_super` BOOLEAN NOT NULL DEFAULT 0,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`admin_id`)
);";   
    }

    public function down() {
        return "DROP TABLE IF EXISTS `admins`";
    }
}