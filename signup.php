<?php 
    include 'app/helpers/session_helper.php';

    include('views/partials/header.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        /* Password section styling */
        .password-section {
            flex: 1 1 100%; /* Full width for password fields */
            display: flex;
            gap: 1rem; /* Space between password fields */
            align-items: center; /* Center align vertically */
        }

        /* Focus state for inputs */
        form input:focus {
            border-color: var(--accent-orange);
            box-shadow: 0 0 0 3px rgba(210, 105, 30, 0.2);
        }

        /* Button Styling */
        form button {
            width: 100%; /* Full width */
            margin-top: 1.5rem;
            padding: 12px 24px;
            background-color: var(--accent-orange);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        form button:hover {
            background-color: var(--accent-pink);
            transform: translateY(-2px);
        }

        /* Toggle password visibility button */
        .toggle-pass {
            background: #D2691E;
            border: none; /* Remove default border */
            cursor: pointer; /* Change cursor to pointer */
            font-size: 20px; /* Adjust font size */
            padding: 5px; /* Add some padding */
            position: relative; /* Allows positioning if needed */
            right: 10px; /* Positioning from the right */
            top: -10px; /* Adjust this value to move the button up */
        }

        /* Optional: Add hover effect */
        .toggle-pass:hover {
            color: #007BFF; /* Change color on hover */
            transform: scale(1.1); /* Slightly enlarge on hover */
        }

        /* Animations */
        @keyframes formAppear {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Password requirements styling */
        .password-requirements {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
            flex-basis: 100%; /* Ensure full width under the password fields */
            display: flex; /* Use flexbox to align items */
            gap: 1rem; /* Space between requirement items */
            align-items: center; /* Center align vertically */
            justify-content: space-between; /* Space evenly between items */
        }

        .requirement-item {
            display: flex;
            align-items: center;
        }

        .check {
            display: none;
            color: green;
            margin-right: 5px;
        }

        .x {
            display: none;
            color: red;
            margin-right: 5px;
        }

        .requirement-item.valid .check {
            display: inline;
        }

        .requirement-item.valid .x {
            display: none;
        }

        .requirement-item.invalid .x {
            display: inline;
        }

        .requirement-item.invalid .check {
            display: none;
        }
    </style>
</head>
<body>
<br>
<h1 class="header">Please Signup</h1>

<?php flash('register') ?>

<form method="post" action="signup-action">
    <input type="hidden" name="type" value="register">
    
    <input type="text" name="customerName" placeholder="Full name..." required> <!-- Added name attribute -->
    <input type="text" name="customerUsername" placeholder="Username..." required> <!-- Changed to customerUsername for clarity -->
    <input type="email" name="customerEmail" placeholder="Email..." required>


    <!-- Password fields organized in a separate section -->
    <div class="password-section">
        <input type="password" name="customerPassword" placeholder="Password..." required>
        <input type="password" name="pwdRepeat" placeholder="Repeat password" required>
    </div>

    <!-- Password requirements list -->
    <div class="password-requirements" id="password-requirements"></div>

    <!-- New fields for address and phone number -->
    <input type="text" name="customerAddress" placeholder="First Address..." required>
    <input type="text" name="customerAddress2" placeholder="Second Address... (optional)">
    <input type="tel" name="customerPhone" placeholder="Phone number must be exactly 10 digits and start with 07..." 
       pattern="^07\d{8}$"
       required oninput="this.value = this.value.replace(/[^0-9]/g, '');">

    <button type="submit" name="submit">Sign Up</button>
</form>
<br>
<script src="public/js/passwordStrength.js"></script>
<script src="public/js/signupanimation.js"></script>

<?php
    include_once('views/partials/footer.php');
    ?>
</body>
</html>
