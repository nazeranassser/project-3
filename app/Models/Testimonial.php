<?php
namespace App\Models;
use App\Models\Model;

class Testimonial extends Model{
    // Properties
    private $conn;
    private $id;
    private $name;
    private $text;
    
    public function __construct() {
        parent::__construct('testimonials');
    }

  

    public function getAll(){
        return $this->get();
    }

}

