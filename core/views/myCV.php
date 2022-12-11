<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container p-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">

                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">

                            <h5 class="text-uppercase text-center mb-2">Your CV</h5>

                            <div class="px-3 bg-light text-dark">
                                <h5 class="fw6">Profile information</h5>
                            </div>
                            <div class="px-3">
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">First name: </p>
                                    <p><?php echo $_SESSION["res_profile"][0]->first_name ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Last name: </p>
                                    <p><?php echo $_SESSION["res_profile"][0]->last_name ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Current salary: </p>
                                    <p><?php echo $_SESSION["res_profile"][0]->current_salary ?></p>
                                </div>
                            </div>

                            <div class="px-3 bg-light text-dark">
                                <h5 class="fw6">Education information</h5>
                            </div>

                            <div class="px-3">
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Certificate type: </p>
                                    <p><?php echo $_SESSION["res_education"][0]->certificate_degree_name ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Major: </p>
                                    <p><?php echo $_SESSION["res_education"][0]->major ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">School name: </p>
                                    <p><?php echo $_SESSION["res_education"][0]->Institute_university_name ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Starting-date: </p>
                                    <p><?php echo $_SESSION["res_education"][0]->starting_date ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Completion-date: </p>
                                    <p><?php echo $_SESSION["res_education"][0]->completion_date ?></p>
                                </div>
                            </div>
                            <div class="px-3 bg-light text-dark">
                                <h5 class="fw6">Experience information</h5>
                            </div>
                            <div class="px-3">
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Start date: </p>
                                    <p><?php echo $_SESSION["res_experience"][0]->start_date ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">End date: </p>
                                    <p><?php echo $_SESSION["res_experience"][0]->end_date ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Job title: </p>
                                    <p><?php echo $_SESSION["res_experience"][0]->job_title ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Company name: </p>
                                    <p><?php echo $_SESSION["res_experience"][0]->company_name ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="fw6">Description: </p>
                                    <p><?php echo $_SESSION["res_experience"][0]->description ?></p>
                                </div>
                            </div>

                            <!--                            --><?php
//                            print_r($_SESSION["res_profile"]);
//                            print_r($_SESSION["res_education"]);
//                            print_r($_SESSION["res_experience"]);
//                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>