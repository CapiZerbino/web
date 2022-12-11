<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12">
                    <div class="widget">
                        <img src="images/logo-white.png" width="180" class="m-b15" alt="" />
                        <p class="text-capitalize m-b20">JobFinding is the leading job search website in Vietnam. Unlike other job search sites, here you can find tens of thousands of job openings from many sources in Vietnam including job search aggregators, from many employers and Vietnamese companies. We understand that finding a job takes a lot of time and effort, so we're always trying to make our website easy to use and convenient.</p>
                        <div class="subscribe-form m-b20">
                            <form class="dzSubscribe" action="" method="post">
                                <div class="dzSubscribeMsg"></div>
                                <div class="input-group">
                                    <input name="dzEmail" required="required" class="form-control" placeholder="Your Email Id"
                                           type="email">
                                    <span class="input-group-btn">
                                        <button name="submit" value="Submit" type="submit" class="site-button radius-xl">Subscribe</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-8 col-sm-8 col-12">
                    <div class="widget border-0">
                        <h5 class="m-b30 text-white">Site Navigations</h5>
                        <ul class="list-2 list-line">
                            <li><a href="home">Home</a></li>
                            <li><a href="cv/all">View all CVs</a></li>
                            <li><a href="cv/create">Create a CV</a></li>
                            <li><a href="recruit/all">View all JDs</a></li>
                            <li><a href="recruit/create">Create a JD</a></li>
                            <li><a href="info">Sitemap</a></li>
                            <?php if (isset($_SESSION)) {
                                if ($_SESSION['logged']) {
                                    echo '<li><a class="link-info" href="user/view/' . $_SESSION['id'] . '">View your profile</a></li><br>';
                                }
                                if ($_SESSION['logged'] && $_SESSION['user_type'] == 'admin') {
                                    echo '<li><a class="link-info" href="admin">Manage users</a></li><br>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="widget border-0">
                        <h5 class="m-b30 text-white">Find Jobs</h5>
                        <ul class="list-2 w10 list-line">
                            <li><a href="login">Login</a></li>
                            <li><a href="register">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>