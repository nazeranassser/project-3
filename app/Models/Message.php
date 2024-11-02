<?php
namespace App\Models;
use App\Models\Model;

class Message extends Model{

    public $message_id;
    public $customer_id;
    public $message_text;
    public $message_subject;
    public $created_at;

}
