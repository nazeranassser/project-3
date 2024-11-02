<?php 
    require_once 'app/helpers/session_helper.php';
    require_once ('views/partials/header.php');
?>
<br><br><br>
<h1 class="header">Get Ready to Savor!</h1>

<?php flash('login') ?>


<form style="display: flex !important; flex-direction: column !important; padding:60px !important; " method="post" action="login-add">
    
    <input type="hidden" name="type" value="login">
    
    <input type="text" name="customerNameOrEmail" placeholder="Username/Email..." required> <!-- Updated name for clarity -->
    <input type="password" style="margin-top:20px" name="customerPassword" placeholder="Password..." required> <!-- Updated name for clarity -->
    
    <button type="submit" name="submit">Log In</button>
</form>

<div class="form-sub-msg"><a href="/signup.php">Sign Up?</a></div>
<br><br><br>
<script src="public/js/forms.js"></script>

<?php 
    include_once('views/partials/footer.php');
    ?>
