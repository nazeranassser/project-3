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
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/product-details.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php $cartItems = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];?>
    <style>
/* Main navigation styling */
nav {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Ensures even spacing between elements */
    padding: 10px 20px;
}

.logo-section {
}

/* Center navigation links on larger screens */
.nav-links {
    display: flex;
    gap: 40px;
    flex: 1;
    justify-content: center;
}

.icons {
    display: flex;
    gap: 30px;
}

.menu-toggle {
    display: none; /* Hide menu toggle icon by default */
}

/* Responsive Styling */
@media (max-width: 768px) {
    /* Hide nav links by default on small screens */
    .nav-links {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 50px;
        right: 20px;
        /* width: 100%; */
        background-color: #F8E1D4;
        padding: 10px;
        box-shadow: 0 0 21px 0 rgba(0, 0, 0, 0.1);
        color:#D2691E;
        font-weight: bold;
        border-radius: 10px;
        z-index: 1000;
    }

    /* Show menu toggle icon on small screens */
    .menu-toggle {
        display: block;
    }

    /* Show nav links when active */
    .nav-links.active {
        display: flex;
    }
}

    </style>
</head>
<body>
<nav>
        <div class="logo-section">
            <a href="#" class="logo nav-item" style="animation-delay: 0.1s;">
                <!-- <img src="/images/3-removebg-preview.png" style="margin-right: 10px; width:40px"> -->
                Revoly Cake
            </a>
        </div>

    <div class="nav-links" id="nav-links">
        <a href="/" class="nav-item" style="animation-delay: 0.2s;">Home</a>
        <a href="/about-us" class="nav-item" style="animation-delay: 0.3s;">About Us</a>
        <a href="/allProducts" class="nav-item" style="animation-delay: 0.4s;">Products</a>
        <a href="/contactform.php" class="nav-item" style="animation-delay: 0.5s;">Contact</a>
    </div>

    <div class="icons">
        <div class="icon nav-item" style="animation-delay: 0.6s;">
            <a href="/allProducts" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <img style="width:24px" src="/public/images/magnifying-glass-2.png" alt="">
            </a>
        </div>
        <div class="icon nav-item" style="animation-delay: 0.6s;">
            <a href="/wishlist" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <img style="width:24px" src="/images/products/wishlist.png" alt="">
                <span class="icon-badge">2</span>
            </a>
        </div>
        <div class="icon nav-item" style="animation-delay: 0.7s;">
        <a href='/cart/' style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <img style="width:24px" src="/images/products/grocery-store.png" alt="">
                <span class="icon-badge"><?php echo count($cartItems); ?></span>
            </a>
        </div>
        <div class="icon nav-item" style="animation-delay: 0.7s;">
            <a href="<?= isset($_SESSION['usersId'])?'/profile-main':'/login'?>" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <img style="width:30px; background-color:#fff; border-radius:200%; padding:2px" src="<?php if(!isset($_SESSION['customerImage'])){ echo '/images/user.png'; }else {echo  $_SESSION['customerImage'];} ?>" alt="">
            </a>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <img src="/images/dots.png" alt="Menu" style="width: 24px; cursor: pointer;">
        </div>
    </div>

    <!-- Menu Toggle Icon for Mobile, aligned to the right -->
    
</nav>

<script>
function toggleMenu() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
}


</script>
</body>
</html>
