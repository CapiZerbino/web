<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container p-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="p-3 mb-3  bg-light text-dark">
                        <h5 class="text-uppercase text-center fw6 m-0">Upload CV</h5>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="job/apply/<?php echo $_SESSION["job_post_id"] ?>" >
                        <!-- Upload pdf -->
                        <div class="form-group">
                            <label for="validatedCustomFile">Upload CV</label>
                            <div class="custom-file">
                                <input type="file" name="cv_file" class="form-control" accept=".pdf" title="Upload PDF"/>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="submit_profile" class="site-button btn-block btn-lg">Submit your CV</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>