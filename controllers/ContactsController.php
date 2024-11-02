<?php
// Modified ContactsController.php
class ContactsController {
    private $message = '';
    private $messageType = '';

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Check if user is logged in when they try to submit
            if (!isset($_SESSION['usersId'])) {
                $this->message = 'You must log in to contact us!';
                $this->messageType = 'warning';
                return;
            }

            $contact = new Contact();

            // Get the logged-in customer's ID
            $customerId = isset($_SESSION['usersId']) ? $_SESSION['usersId'] : null;

            // Sanitize input data
            $name = htmlspecialchars(strip_tags($_POST['name']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $subject = htmlspecialchars(strip_tags($_POST['subject']));
            $message_text = htmlspecialchars(strip_tags($_POST['message']));

            // Set the data including customer_id
            $contact->setData($name, $email, $subject, $message_text, $customerId);

            if (!$contact->validate()) {
                $this->message = 'Please fill all fields correctly';
                $this->messageType = 'danger';
            } else {
                if ($contact->save()) {
                    $this->message = 'Message sent successfully!';
                    $this->messageType = 'success';
                    $_POST = array();
                } else {
                    $this->message = 'Something went wrong. Please try again.';
                    $this->messageType = 'danger';
                }
            }
        }
    }

    public function getMessage() {
        return $this->message;
    }

    public function getMessageType() {
        return $this->messageType;
    }
}