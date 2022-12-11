<div class='bg-light'>
    <div class='container'>
        <nav class='container navbar navbar-expand-lg navbar-light '>
            <a class='navbar-brand' href='home'>Job Seeker</a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarText' aria-controls='navbarText' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarText'>
                <ul class='navbar-nav mr-auto'>
                    <li class='nav-item'>
                        <a class='nav-link' href='job/find'>Find a job</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='company/find'>Find a company</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='job/all'>All job</a>
                    </li>
                    <?php
                        if(isset($_SESSION['user_type']))
                        {
                            switch ($_SESSION['user_type'])
                            {
                                case 'admin':
                                    break;
                                case 'candidate':
                                    echo "
                                    <li class='nav-item'>
                                        <a class='nav-link' href='profile/update'>Update CV</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='profile/view'>My CV</a>
                                    </li>
                                    ";
                                    break;
                                case 'employee':
                                    echo "
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='job/create'>Create a job description</a>
                                    </li>
                                    ";
                                    break;
                                case 'guest':
                                    break;
                            }
                        }
                    ?>


                </ul>
                <span class='navbar-text'>
                <?php
                if(isset($_SESSION['email']) && $_SESSION['email'] !== '') {
                    echo $_SESSION['email'] . ' | ';
                    echo $_SESSION['user_type'] ;
                }
                ?>
            </span>
                <?php
                if(empty($_SESSION['id'])) {
                    echo "<a class='nav-link' href='login'>Log in</a>";
                } else {
                    echo "<a class='nav-link' href='logout'>Log out</a>";
                }
                ?>
            </div>
        </nav>
    </div>
</div>

