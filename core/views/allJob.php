<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container p-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <h2 class="text-uppercase text-center mb-5">All job</h2>
                        <div>
                            <?php
                            if(!empty($_SESSION["result"])) {
                                foreach ($_SESSION["result"] as $job) {
                                    echo "
                                    <div class='card my-3'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>Company: $job->company_name</h5>
                                            <h6 class='card-subtitle mb-2 text-muted'>Jobdescription: $job->job_description</h6>
                                            <p class='card-text'>Created date: $job->created_date</p>
                                            <a href='job/apply/$job->job_id' class='card-link'>Apply this job</a>
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