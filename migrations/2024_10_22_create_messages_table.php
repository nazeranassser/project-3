<?php

class CreateMessagesTable
{
    public function up()
    {
        return "CREATE TABLE IF NOT EXISTS `messages` (
            `message_id` int(11) NOT NULL AUTO_INCREMENT,
            `customer_id` int(11) NOT NULL,
            `message_subject` varchar(255) NOT NULL,
            `message_text` text NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`message_id`),
            foreign key (customer_id) references customers(customer_id)
            )";
    }

    public function down()
    {
        return "DROP TABLE IF EXISTS `messages`";   

    }   
}   