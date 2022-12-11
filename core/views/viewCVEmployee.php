<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container p-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <h2 class="text-uppercase text-center mb-5">Your job applied</h2>
                    <div>
                        <?php
                        if(!empty($_SESSION["job_applied"])) {
                            foreach ($_SESSION["job_applied"] as $cv) {
                                echo "
                                    <div class='card my-3'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>Email: $cv->email</h5>
                                             <h6 class='card-subtitle mb-2 text-muted'>Candidate with id $cv->user_id</h6>
                                             <a href='profile/view/$cv->user_id' class='site-button'>View CV</a>
                                        </div>
                                    </div>
                                    ";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>