<header class="site-header mo-left header fullwidth">
    <!-- main header -->
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container-fluid clearfix">
                <!-- website logo -->
                <div class="logo-header mostion">
                    <a href="home"><img src="images/logo.png" class="logo" alt=""></a>
                </div>
                <!-- nav toggle button -->
                <!-- nav toggle button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse"
                        data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- extra nav -->
                <?php
                if ($_SESSION['logged']) {
                    echo "
                        <div class='extra-nav'>
                            <div class='extra-cell'>
                                <a href='#' class='site-button'>"  .$_SESSION['email'].' | '. $_SESSION['user_type'] ."</a>
                                <a href='logout' class='site-button'><i class='fa fa-sign-out'></i> Log Out</a>
                            </div>
                        </div>
                        ";
                } else {
                    echo '
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <a href="register" class="site-button"><i class="fa fa-user"></i> Register</a>
                                <a href="login" class="site-button"><i class="fa fa-lock"></i> Login</a>
                            </div>
                        </div>
                        ';
                }
                ?>
                <!-- main nav -->
                <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <ul class="nav navbar-nav">
                        <li class="">
                            <a href="home">Home</a>
                        </li>
                        <li>
                            <a href="home/sitemap">Site Map</a>
                        </li>
                        <li>
                            <a href="company/find">Find a company</a>
                        </li>
                        <li>
                            <a href="job/all">All job</a>
                        </li>
                        <?php
                        if(isset($_SESSION['user_type']))
                        {
                            switch ($_SESSION['user_type'])
                            {
                                case 'admin':
                                    echo "
                                    <li>
                                        <a href='#'>For Admin <i class='fa fa-chevron-down'></i></a>
                                        <ul class='sub-menu''>         
                                            <li><a href='admin' class='dez-page'>Dashboard</a></li>   
                                            <li><a href='admin/user-management' class='dez-page'>User management</a></li>
                                            <li><a href='admin/company-management' class='dez-page'>Company Management</a></li>
                                        </ul>
                                    </li>
                                    ";
                                    break;
                                case 'candidate':
                                    echo "
                                    <li>
                                        <a href='#'>For Candidates <i class='fa fa-chevron-down'></i></a>
                                        <ul class='sub-menu''>            
                                            <li><a href='profile/update' class='dez-page'>Update CV</a></li>
                                            <li><a href='profile/view' class='dez-page'>My CV</a></li>
                                            <li><a href='profile/job-applied' class='dez-page'>View your job applied</a></li>
                                        </ul>
                                    </li>
                                    ";
                                    break;
                                case 'employee':
                                    echo "
                                    <li>
                                        <a href='#'>For Employers <i class='fa fa-chevron-down'></i></a>
                                        <ul class='sub-menu'>
                                            <li><a href='job/create' class='dez-page'>Create Job Description</a></li>
                                            <li><a href='company/cv-applied' class='dez-page'>View CV applied</a></li>
                                        </ul>
                                    </li>
                                    ";
                                    break;
                                case 'guest':
                                    break;
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main header END -->
</header>