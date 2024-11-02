<?php include('views/partials/header.php') ?> 

<link rel="stylesheet" href="public/css/app.css">


<div id="app">
    <div class="app-content">
        

        <div class="u-s-p-b-60">
            <div class="section__content">
                <div class="dash">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                    <div class="dash__pad-1">
                                        <span class="dash__text u-s-m-b-16"><?php echo  'Hello ' . htmlspecialchars($_SESSION['usersName']) ; ?></span>
                                        <ul class="dash__f-list">
                                            <li><a class="dash-active" href="">Manage My Account</a></li>
                                            <li><a href="profile-main">My Profile</a></li>
                                            
                                            <li><a href="profile-order">My Orders</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-12">
                                <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white">
                                    <div class="dash__pad-2">
                                        <h1 class="dash__h1 u-s-m-b-14">Edit Profile</h1>
                                        <span class="dash__text u-s-m-b-30">Looks like you haven't updated your profile</span>
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form method="POST" class="dash-edit-p" enctype="multipart/form-data" action="profile-update">
                                                    <div class="gl-inline">
                                                        <div class="u-s-m-b-30">
                                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['customer_id']); ?>">
                                                            <label class="gl-label" for="reg-fname">First name</label>
                                                            <input class="input-text input-text--primary-style" name="firstname" type="text" id="reg-fname" 
                                                                value="<?php echo htmlspecialchars($customer['customer_name']); ?>" required>
                                                        </div>
                                                        <div class="u-s-m-b-30">
                                                            <label class="gl-label" for="reg-email">Email</label>
                                                            <input class="input-text input-text--primary-style" name="email" type="email" id="reg-email" 
                                                                value="<?php echo htmlspecialchars($customer['customer_email'] ); ?>" required>
                                                        </div>
                                                        <div class="u-s-m-b-30">
                                                            <label class="gl-label" for="reg-phone">Phone number</label>
                                                            <input class="input-text input-text--primary-style" name="phone" type="tel" id="reg-phone" 
                                                                value="<?php echo htmlspecialchars($customer['customer_phone']); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="gl-inline">
                                                        <div class="u-s-m-b-30">
                                                            <label class="gl-label" for="reg-address1">Address 1</label>
                                                            <input class="input-text input-text--primary-style" name="address1" type="text" id="reg-address1" 
                                                                value="<?php echo htmlspecialchars($customer['customer_address1']); ?>">
                                                        </div>
                                                        <div class="u-s-m-b-30">
                                                            <label class="gl-label" for="reg-address2">Address 2 (Optional)</label>
                                                            <input class="input-text input-text--primary-style" name="address2" type="text" id="reg-address2" 
                                                                value="<?php echo htmlspecialchars($customer['customer_address2']); ?>">
                                                        </div>
                                                        <div class="u-s-m-b-30">
                                                            <label class="gl-label" for="customer-image">Profile Image</label>
                                                            <?php if(!empty($customer['image'])): ?>
                                                                <div class="current-image mb-2">
                                                                    <img src="<?php echo htmlspecialchars($customer['image']); ?>" 
                                                                        alt="Current Profile" style="max-width: 150px;">
                                                                </div>
                                                                </div>
                                                            <?php endif; ?>
                                                            <input type="file" name="image" id="customer-image" accept="image/*" class="form-control">
                                                        </div>
                                                    </div>
                                                    <?php if(!empty($message)): ?>
                                                        <div class="alert <?php echo $message == 'The data has been updated successfully.' ? 'alert-success' : 'alert-danger'; ?> u-s-m-b-30">
                                                            <?php echo htmlspecialchars($message); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <button class="btn btn--e-brand-b-2" name="edit" type="submit">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('views/partials/footer.php') ?> 