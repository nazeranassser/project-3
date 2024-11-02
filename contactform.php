
<?php
session_start();
include_once('views/partials/header.php');
require_once 'libraries/Database.php';
require_once 'models/Contact.php';
require 'controllers/ContactsController.php';

// // Start session if not already started
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

$contactController = new ContactsController();
$contactController->handleRequest();

$message = $contactController->getMessage();
$messageType = $contactController->getMessageType();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/contact.css">
</head>
<body>
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="row gy-4">
                <h1>Contact Us</h1>
                
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo htmlspecialchars($messageType); ?>" role="alert">
                        <?php echo htmlspecialchars($message); ?>
                        <?php if ($messageType === 'warning'): ?>
                            <!-- <a href="login.php" class="btn btn-primary btn-sm ms-3">Sign In</a> -->
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

     
                <div class="col-lg-6">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Address</h3>
                                <p>A108 Adam Street,<br>New Delhi, 535022</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-telephone"></i>
                                <h3>Call Us</h3>
                                <p>+91 9876545672<br>+91 8763456243</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-envelope"></i>
                                <h3>Email Us</h3>
                                <p>bragspot@gmail.com<br>brag@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-clock"></i>
                                <h3>Open Hours</h3>
                                <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 form">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="php-email-form">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required 
                                    value="<?php echo isset($_SESSION['usersName']) ? htmlspecialchars($_SESSION['usersName']) : (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required
                                    value="<?php echo isset($_SESSION['customerEmail']) ? htmlspecialchars($_SESSION['customerEmail']) : (isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''); ?>">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required
                                    value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" name="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php     include_once('views/partials/footer.php');?>

</body>
</html>
