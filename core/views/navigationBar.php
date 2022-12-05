<div class="bg-light">
    <div class="container">
        <nav class="container navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="home">Job Seeker</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="createJobDescription">Create a job description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="findJob">Find a job</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
                <span class="navbar-text">
                <?php
                if(isset($_SESSION['email']) && $_SESSION['email'] !== '') {
                    echo $_SESSION['email'];
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

