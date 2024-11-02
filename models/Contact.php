<?php
class Contact {
    private $db;
    private $message_id;
    private $customer_id;
    private $name;
    private $email;
    private $message_subject;
    private $message_text;
    private $created_at;
    private $updated_at;

    public function __construct() {
        $this->db = new Database();
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function setData($name, $email, $subject, $message, $customer_id) {
        $this->name = $name;
        $this->email = $email;
        $this->message_subject = $subject;
        $this->message_text = $message;
        $this->customer_id = $customer_id;
    }

    public function validate() {
        if (empty($this->name) || empty($this->email) || 
            empty($this->message_subject) || empty($this->message_text)) {
            return false;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public function save() {
        $this->db->query('INSERT INTO messages (
            customer_id, 
            message_subject, 
            message_text, 
            created_at, 
            updated_at
        ) VALUES (
            :customer_id, 
            :message_subject, 
            :message_text, 
            :created_at, 
            :updated_at
        )');

        // Bind values
        $this->db->bind(':customer_id', $this->customer_id);
        $this->db->bind(':message_subject', $this->message_subject);
        $this->db->bind(':message_text', $this->message_text);
        $this->db->bind(':created_at', $this->created_at);
        $this->db->bind(':updated_at', $this->updated_at);

        // Execute
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }
}