
        <?php include('views/partials/header_admin.php');?>

        <!--====== End - Main Header ======-->

        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->
            <div class="u-s-p-y-20">

                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="breadcrumb">
                            <div class="breadcrumb__wrap">
                                <ul class="breadcrumb__list">
                                    <li class="has-separator">

                                        <a href="index.html">Home</a></li>
                                    <li class="is-marked">

                                        <a href="dash-address-book.php">Admins</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <?php
                                    include('views/admin/dashboard_features.php');
                                    ?>
                                    <!--====== End - Dashboard Features ======-->
                                    <div>

                                        <a class="dash__custom-link btn--e-brand-b-2" href="/add-admin"><i class="fas fa-plus u-s-m-r-8"></i>

                                            <span>Add New Admin</span></a></div>
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
                                    <div class="dash__pad-2" style="display:flex;justify-content: space-between;padding-right:30px">
                                            <div class="dash__address-header">
                                                <h1 class="dash__h1">Admins</h1>
                                            </div>
                                            <div class="dash__filter">
                                                <form method="GET" action="/admins/" id="categoryForm">
                                                    <select class="select-box select-box--primary-style" style="border-radius:6px" name="active" id="categoryFilter" onchange="this.form.submit()">
                                                        <option value="">All Admins</option>                                                            
                                                            <option value="1" 
                                                                <?= isset($_GET['active']) && $_GET['active'] == 1 ? 'selected' : '' ?>>
                                                                Active Admins
                                                            </option>
                                                            <option value="false" 
                                                                <?= isset($_GET['active']) && $_GET['active'] == 'false' ? 'selected' : '' ?>>
                                                                Deactivate Admins
                                                            </option>
                                                    </select>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="dash__table-2-wrap gl-scroll">
                                            <table class="dash__table-2">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th style='text-align:center'>View</th>
                                                        <th style='text-align:center'>Active</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                            
                                              
                                                  foreach($admins as $admin) {
                                                    if($admin['is_super']==1){
                                                        continue;
                                                    }
                                                    if($admin['is_active']==1){
                                                        $active = 'Active';
                                                        $value = 0;
                                                        $style = "style='background-color:green; border:0;width:100px'";
                                                    }else{
                                                        $active = 'Deactivate';
                                                        $value = 1;
                                                        $style = '';
                                                    }
                                                    echo "  <tr>
                                                    <form method='POST' action='/edit-admin/".$admin['admin_id']."'>
                                                            <th>".$admin['admin_name']."</th>
                                                            <th>".$admin['admin_email']."</th>
                                                            <th  style='text-align:center'>
                                                            <button type='submit' class='address-book-edit btn--e-transparent-platinum-b-2' style='margin-right:4px ;'>Edit</button>
                                                            </form></th>
                                                            <th style='display: flex; justify-content:center'>
                                                            <form method='GET' action='/delete-admin/".$admin['admin_id']."'>
                                                            <input type='text' value='".$value."' name='admin_status' style='visibility: hidden;display: none;'>
                                                            <button class='address-book-edit btn btn--e-brand-b-2'". $style." >".$active."</button>
                                                            </form></th>
                                                        </tr>";
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
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
        <!--====== End - App Content ======-->


        <!--====== Main Footer ======-->
       <?php include('views/partials/footer_admin.php');?>
    </div>
    <!--====== End - Main App ======-->


  