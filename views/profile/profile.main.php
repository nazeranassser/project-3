<?php include('views/partials/header.php');


 ?> 

<link rel="stylesheet" href="public/css/app.css">

 
        <div class="app-content">
            

            <!--====== Section 1 ======-->
            
            <!--====== End - Section 1 ======-->


            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="dash">
                        <div class="container">
                            
                            <div class="row">
                                
                                <div class="col-lg-3 col-md-12">

                                    <!--====== Dashboard Features ======-->
                                    <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                        <div class="dash__pad-1">
                                            

                                            <span class="dash__text u-s-m-b-16"><?php echo "Hello"." ".$_SESSION['usersName']; ?></span>
                                            <ul class="dash__f-list">
                                                <li>

                                                    <a href="profile-edit">Manage My Account</a></li>
                                                <li>

                                                    <a class="dash-active" href="profile-main">My Profile</a></li>
                                              
                                                <li>

                                                    <a href="profile-order">My Orders</a></li>
                                             

                                            </ul>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <!--====== End - Dashboard Features ======-->
                                </div>
                                
                                <div class="col-lg-9 col-md-12">
                                    
                                    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
                                        <div class="dash__pad-2">
                                            <h1 class="dash__h1 u-s-m-b-14">My Profile</h1>

                                            <span class="dash__text u-s-m-b-30">Look all your info, you could customize your profile.</span>
                                            <div class="row">
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <h2 class="dash__h2 u-s-m-b-8">First Name</h2>

                                                    <span class="dash__text"><?php echo $customer['customer_name']; ?></span>
                                                </div>
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <h2 class="dash__h2 u-s-m-b-8">E-mail</h2>

                                                    <span class="dash__text"><?php echo $customer['customer_email']; ?></span>
                                                    <div class="dash__link dash__link--secondary">

                                                        <a href="#"></a></div>
                                                </div>
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <h2 class="dash__h2 u-s-m-b-8">Phone</h2>

                                                    <span class="dash__text"><?php echo $customer['customer_phone'] ?></span>
                                                    <div class="dash__link dash__link--secondary">

                                                        <a href="#"></a></div>
                                                </div>
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <h2 class="dash__h2 u-s-m-b-8">address1</h2>

                                                    <span class="dash__text"><?php echo $customer['customer_address1']; ?></span>
                                                </div>
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <h2 class="dash__h2 u-s-m-b-8">address2</h2>

                                                    <span class="dash__text"><?php echo $customer['customer_address2']; ?></span>
                                                    <div class="dash__link dash__link--secondary">

                                                        <a href="#"></a></div>
                                                </div>
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    <h2 class="dash__h2 u-s-m-b-8">image</h2>

                                                   <img src="<?php echo $customer['customer_image'] ?>" alt="" style="border-radius: 60px;width:60px;"> 
                                                    <div class="dash__link dash__link--secondary">

                                                        <a href="#"></a></div>
                                                </div>
                                                <div class="col-lg-4 u-s-m-b-30">
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="dash__link dash__link--secondary u-s-m-b-30">

                                                        
                                                    <div class="u-s-m-b-16">

                                                        <a class="dash__custom-link btn--e-transparent-brand-b-2" href="profile-edit">Edit Profile</a></div>

                                                </div>
                                            </div>
                                        </div>
                                        <a href="/sign-out" class="dash__custom-link btn--e-brand-b-2" style="animation-delay: 0.8s;">Logout</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 2 ======-->
        </div>
        <?php include('views/partials/footer.php') ?> 
