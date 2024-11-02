
<?php 
    include_once('views/partials/header.php');
    include_once 'app/helpers/session_helper.php';
?>
    <h1 class="header">Reset Password</h1>

    <?php flash('reset') ?>

    <form method="post" action="./controllers/ResetPasswords.php">
        <input type="hidden" name="type" value="send" />
        <input type="text" name="usersEmail" 
        placeholder="Email...">
        <button type="submit" name="submit">Receive Email</button>
    </form>
    <script src="public/js/forms.js"></script>

<?php 
    include_once('views/partials/footer.php');
    ?>