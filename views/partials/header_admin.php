<?php
// session_start();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/images/favicon.png" rel="shortcut icon">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!--====== Google Font ======-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
    <!--====== Vendor Css ======-->
    <link rel="stylesheet" href="/public/css/vendor.css">
    <!--====== Utility-Spacing ======-->
    <link rel="stylesheet" href="/public/css/utility.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--====== App ======-->
    <link rel="stylesheet" href="/views/partials/admin.css">
    <link rel="stylesheet" href="/public/css/drop_drag_img.css">
    <link rel="stylesheet" href="/new_css.css">
     <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

/* Define color variables */
.button {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: rgb(20, 20, 20);
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
  cursor: pointer;
  transition-duration: .3s;
  overflow: hidden;
  position: relative;
}

.svgIcon {
  width: 12px;
  transition-duration: .3s;
}

.svgIcon path {
  fill: white;
}

.button:hover {
  width: 140px;
  border-radius: 50px;
  transition-duration: .3s;
  background-color: rgb(255, 69, 69);
  align-items: center;
}

.button:hover .svgIcon {
  width: 50px;
  transition-duration: .3s;
  transform: translateY(60%);
}

.button::before {
  position: absolute;
  top: -20px;
  content: "Delete";
  color: white;
  transition-duration: .3s;
  font-size: 2px;
}

.button:hover::before {
  font-size: 13px;
  opacity: 1;
  transform: translateY(30px);
  transition-duration: .3s;
}
:root {
    --color-1: #F191AC;  /* Primary color */
    --color-2: #F6A6BB;  /* Secondary color */
    --color-3: #F4BBC9;  /* Tertiary color */
    --color-4: #FAE6E7;  /* Light color */
    /* --color-5: #F7EEED;  Background color */
    --color-5: #FFF8DC;  /* Background color */
}
body {
    background-color: #FFFAF3;
}

.container-xxl{
    max-width: 1500px;
}
/* Global Styles */
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.admin_list{
    padding:10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    align-content: center;
    
}
.admin_list_div{
    display: flex;
    justify-content: space-between;
    align-items: center;
    align-content: center;
}
.dash_img{
    width: 20px ;
    height: 20px ;
    margin-right:14px ;
    align-items: center;
    align-content: center;
}
/* .admin_list div{
    display: flex;
    justify-content: start;
    align-items: center;
    align-content: center;
} */

/* navbar section  */
/* Navbar Section */
.navbar {
    padding: 20px;
    background: linear-gradient(to right, #00093c, #2d0b00);
    background: linear-gradient(to right, var(--color-1), var(--color-2));
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
}

.navbar .navbar-toggler {
    color: #000 !important;
    color: #fff !important;
    background: #fff;
    border-radius: 50%;
    padding: 15px;
    outline: none;
    border: none;
}

.navbar #navbarNav {
    text-align: center;
    width: 100%;
    margin-top: 20px;
}

.navbar .navbar-brand {
    color: #f1f1f1;
    color: var(--color-4);
    font-size: 30px;
    margin-left: 0px;
    margin-left: 0;
    font-weight: 600;
}

.navbar .navbar-brand i {
    font-size: 25px;
    background: linear-gradient(to right, #00093c, #2d0b00);
    border-radius: 50%;
    padding: 10px 15px;}
.navbar .navbar-brand img {
    margin-right: 10px; 
}

.navbar .collapse {
    background: linear-gradient(to right, #00093c, #2d0b00);
}
.navbar .dropdown-menu{
    width: 12px;
    background: linear-gradient(to right, var(--color-1), var(--color-2));
}

.navbar .dropdown-menu li a{
    color: linear-gradient(to right, #00093c, #2d0b00);
    font-size: 15px;}
.navbar ul {
    padding-left: 0;
}

.navbar ul li .bi{
    background: #fff;
    color: linear-gradient(to right, #00093c, #2d0b00);
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 50%;}
.navbar ul li {
    list-style: none;
}

.navbar ul li a {
    color: #f1f1f1;
    color: var(--color-4);
    text-decoration: none;
    text-transform: capitalize;
    font-size: 18px;
    margin-right: 40px;
    margin: 0 15px; 
}

.navbar ul li a:hover {
    color: #FFB6C1;
    color: var(--color-3);
}
/* Icon Styles */
.navbar ul li .fa-heart,
.navbar ul li .fa-shopping-bag {
    font-size: 15px;
    color: var(--color-4);
    transition: color 0.3s ease;
}

.navbar ul li .fa-heart:hover,
.navbar ul li .fa-shopping-bag:hover {
    color: var(--color-3);
}

/* contact section  */
/* Optional: Adding a badge for the shopping cart */
.mini-cart-shop-link::after {
    content: '3'; /* Example cart count */
    position: absolute;
    top: -5px;
    right: -10px;
    background: var(--color-3);
    color: #fff;
    font-size: 12px;
    border-radius: 50%;
    padding: 3px 6px;
}

/* Contact Section */
.contact-section {
    background: #fbfbfb;
    background: var(--color-5);
    padding: 100px;
}

.contact-section h1 {
    margin-top: 50px;
    text-align: center;
    text-transform: capitalize;
    font-size: 50px;
    font-weight: bold;
    color: linear-gradient(to right, #00093c, #2d0b00);
    background: linear-gradient(to right, var(--color-1), var(--color-2));
    -webkit-text-fill-color: transparent;
    margin-bottom: 100px;
}

.contact-section .info-box {
    background-color: transparent;
    border: none;
    height: 200px;
    width: 230px;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);
}

.contact-section .info-box .bi {
    background: linear-gradient(to right, #00093c, #2d0b00);
    background: linear-gradient(to right, var(--color-1), var(--color-2));
    border-radius: 55%;
    padding: 15px 18px;
    color: #fff;
    font-size: 25px;
    text-align: center;
}

.contact-section .info-box h3 {
    font-size: 25px;
    margin-top: 30px;
    font-weight: 600;
}

.contact-section .info-box p {
    font-size: 15px;
    color: linear-gradient(to right, #00093c, #2d0b00);
    color: var(--color-1);
}

.contact-section .info-box:hover {
    background: #FFB6C1;
    background: var(--color-3);
    color: #fff;
    transform: scale(0.9);
}

.contact-section .info-box:hover p {
    color: #f1f1f1;
    color: var(--color-4);
}

.contact-section .info-box:hover .bi {
    background: #fff;
    color: #FFB6C1;
    color: var(--color-3);
    font-size: 25px;
    text-align: center;
}

.contact-section .form {
    margin-top: 50px;
}

.contact-section form input,
.contact-section form textarea {
    margin-top: 10px;
    border: none;
    background: #f1f1f1;
    color: #FFB6C1;
    color: var(--color-3);
    padding: 15px;
    border-radius: 10px;
}

.contact-section form button {
    margin-top: 20px;
    border-radius: 30px;
    color: #fff;
    border: none;
    background-color: #2d0b00;
    background-color: var(--color-2);
    height: 50px;
    width: 170px;
    text-transform: capitalize;
}

.contact-section form button:hover {
    background-color: #fff;
    border: 2px solid #FFB6C1;
    color: #2d0b00;
    border: 2px solid var(--color-3);
    color: var(--color-2);
}
@media (max-width: 700px) {
    .contact-section {
        padding: 50px;
    }
}
/* footer section  */
/* Footer Section */
footer {
    background: linear-gradient(to right, #00093c, #2d0b00);
    background: linear-gradient(to right, var(--color-1), var(--color-2));
    border-top-left-radius: 100px;
    position: relative; 
    bottom: 0;
    width: 100%;
    height: auto;
    padding: 40px 0; 
}

footer * {
    color: white;
}
.contain {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 50px 7%;
}

.footer-col {
    width: 25%;
    min-width: 200px;
    margin-bottom: 20px;
}

.footer-col h2, .footer-col h3 {
    font-size: 1.7em;
    text-transform: uppercase;
    margin-bottom: 20px;
}

p.email {
    margin: 30px 0;
}

p.phone {
    font-size: 20px;
    font-weight: 400;
}

.footer-col .text-office {
    margin-bottom: 20px;
}

.underline {
    width: 70px;
    height: 3px;
    position: relative;
    background-color: #FFB6C1;
    background-color: var(--color-3);
    margin-top: 5px;
    margin-bottom: 20px;
    border-radius: 3px;
    overflow: hidden;
}

.underline span {
    width: 7px;
    height: 100%;
    position: absolute;
    left: 10px;
    background-color: rgb(63, 63, 63);
    border-radius: 3px;
    animation: moving 1.5s linear infinite;
}

@keyframes moving {
    0% {
        left: -20px;
    }
    100% {
        left: 100%;
    }
}

.footer-col ul {
    list-style-type: none;
    padding-top: 10px;
}

.footer-col ul li {
    margin: 10px;
}

.footer-col form {
    margin-top: 20px;
    border-bottom: 1px solid white;
    padding-bottom: 10px;
    display: flex;
}

.footer-col form input {
    width: 70%;
    background: transparent;
    border: none;
    outline: none;
    padding-left: 10px;
    color: white;
}

.footer-col form i {
    font-size: 15px;
    color: white;
}

.footer-col .social-icons {
    margin-top: 20px;
}

.footer-col .social-icons i {
    padding: 10px;
    background-color: white;
    color: #00093c;
    color: var(--color-1);
    border-radius: 50%;
    margin: 5px;
}

.footer-para {
    max-width: 250px;
}

/* Back-to-top button */
.back-to-top {
    display: inline-block; 
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: var(--color-1); 
    border-radius: 5px;
    padding: 10px; 
    transition: background-color 0.3s;
    z-index: 1000;
}

      /* back-to-top button */
.back-to-top:hover {
    background-color: var(--color-2);
}

      .back-to-top {
        display: inline-block; 
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #00093c; 
        border-radius: 5px;
        padding: 10px; 
        transition: background-color 0.3s;
        z-index: 1000;
    }
    .back-to-top:hover {
        background-color: #2d0b00;
    }
    .icon-image {
        width: 30px; 
        height: auto;
    }
    .icon-image {
        width: 30px; 
        height: auto;
    }
     </style>
</head>
<body class="config">
    <br>
    <!-- <div class="preloader is-active">
        <div class="preloader__wrap">
            <img class="preloader__img" src="images/preloader.png" alt=""></div>
    </div> -->
    <!--====== Main App ======-->
    <div id="app">

        <!--====== End - Main Header ======-->