<?php 
    // include_once 'views/partials/header.php';
    include_once 'app/helpers/session_helper.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/vendor.css">
    <link rel="stylesheet" href="/public/css/utility.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/public/css/footer.css">
    

</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <br>
<?php flash('Page Not Found') ?>
<h1 class="header" style="font-size:200px">404</h1>
<h1 class="header">Page Not Found !!</h1>
<?php
if(isset($_SESSION['admin_id'])){
    echo '<div class="form-sub-msg"><a href="/dash">Dashboard</a></div>';
}else{
    echo '<div class="form-sub-msg"><a href="/">Home</a></div>';

}
?>

<script src="/public/js/forms.js"></script>

<?php 
    // include_once 'views/partials/footer.php';
?>
