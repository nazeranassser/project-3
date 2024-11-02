                                    <div class="dash__box dash__box--bg-white dash__box--shadow u-s-m-b-30">
                                        <div class="dash__pad-1">

                                            <span class="dash__text u-s-m-b-16">Hello, John Doe</span>
                                            <ul class="dash__f-list">
                                                <li>
                                                <a href="/dash">
                                                    <div class="admin_list">
                                                        <div class="admin_list_div" >
                                                              <img class="dash_img"  src="/images/products/671fb4e759685_dashboard.png" alt="">
                                                              <p>Dashboard</p>
                                                        </div>
                                                        <img style="width:12px" src="/public/images/angle-right.png" alt="">
                                                    </div>
                                                </a>
                                                </li>
                                                <li>
                                                <a href="/products">
                                                    <div class="admin_list">
                                                        <div class="admin_list_div" >
                                                              <img class="dash_img"  src="/public/images/icing.png" alt="">
                                                              <p>Products</p>
                                                        </div>
                                                        <img style="width:12px" src="/public/images/angle-right.png" alt="">
                                                    </div>
                                                </a>
                                                </li>
                                                <?php 
                                                    if($_SESSION['is_super']==1){ echo'
                                                        <li>
                                                        <a href="/admins">
                                                            <div class="admin_list">
                                                                <div class="admin_list_div" >
                                                                      <img class="dash_img"  src="/public/images/administrator.png" alt="">
                                                                      <p>Admins</p>
                                                                </div>
                                                                <img style="width:12px" src="/public/images/angle-right.png" alt="">
                                                            </div>
                                                        </a>
                                                        </li>';
                                                    }?>
                                                <li>
                                                <a href="/coupons">
                                                    <div class="admin_list">
                                                        <div class="admin_list_div" >
                                                              <img class="dash_img"  src="/public/images/coupon.png" alt="">
                                                              <p>Coupons</p>
                                                        </div>
                                                        <img style="width:12px" src="/public/images/angle-right.png" alt="">
                                                    </div>
                                                </a>
                                                </li>
                                                <li>
                                                <a href="/orders">
                                                    <div class="admin_list">
                                                        <div class="admin_list_div" >
                                                              <img class="dash_img"  src="/public/images/box_2.png" alt="">
                                                              <p>Orders</p>
                                                        </div>
                                                        <img style="width:12px" src="/public/images/angle-right.png" alt="">
                                                    </div>
                                                </a>
                                                </li>
                                                <li>
                                                <a href="/admin/customers">
                                                    <div class="admin_list">
                                                        <div class="admin_list_div" >
                                                              <img class="dash_img"  src="/images/products/671fb3380fb81_user.png" alt="">
                                                              <p>Customers</p>
                                                        </div>
                                                        <img style="width:12px" src="/public/images/angle-right.png" alt="">
                                                    </div>
                                                </a>
                                                </li>
                                                <li>
                                                <a href="/orders">
                                                    <div class="admin_list">
                                                        <div class="admin_list_div" >
                                                              <img class="dash_img"  src="/images/email.png" alt="">
                                                              <p>Messages</p>
                                                        </div>
                                                        <img style="width:12px" src="/public/images/angle-right.png" alt="">
                                                    </div>
                                                </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                   