<section class="vh-100 bg-white">
        <div class="mask d-flex align-items-center gradient-custom-3">
            <div class="container p-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <h2 class="text-uppercase text-center mb-5">Create a job description</h2>
                        <form method="post" action="job/create">
                            <!-- Company name -->
                            <div class="form-outline mb-4">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" class="form-control form-control-md" required />
                            </div>
                            <!-- Company desciption -->
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Company Description</label>
                                <textarea class="form-control" name="company_description" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>
                            <!-- Company image -->
                            <div class="form-group">
                                <label for="validatedCustomFile">Company Logo</label>
                                <div class="custom-file">
                                    <input type="file" name="company_image" class="custom-file-input" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose
                                        file...</label>
                                </div>
                                <?php if (!empty($response)) { ?>
                                    <div class="response <?php echo $response["type"]; ?>">
                                        <?php echo $response["message"]; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- Job Type -->
                            <div class="form-group">
                                <label for="validatedCustomFile">Company Type</label>
                                <select class="custom-select" name="company_type" required>
                                    <?php
                                    if($result = $this->result["companyType"])
                                    {
                                        foreach ($result as $key => $value)
                                        {
                                            echo "<option value='" .$key. "'>" .$value."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Company url -->
                            <div class="form-outline mb-4">
                                <label class="form-label">Company URL</label>
                                <input type="text" name="company_url" class="form-control" required/>
                            </div>
                            <!-- Company establishment date -->
                            <div class="form-outline mb-4">
                                <label for="validationCustom03">Company Establishment Date</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="company_establish_date" class="form-control form-control-md" id="date" required/>
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-light d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <!-- Job Skill -->
                            <div class="form-group">
                                <label for="validatedCustomFile">Job Skill</label>
                                <select class="custom-select" name="job_skill" multiple required>
                                    <?php
                                    if($result = $this->result["skillSet"])
                                    {
                                        foreach ($result as $key => $value)
                                        {
                                            echo "<option value='" .$key. "'>" .$value."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Job Skill Level -->
                            <div class="form-group">
                                <label for="validatedCustomFile">Job Skill Level</label>
                                <select class="custom-select" name="job_skill_level" required>
                                    <option value="fresher">Fresher</option>
                                    <option value="junior">Junior</option>
                                    <option value="senior">Senior</option>
                                    <option value="professional">Professional</option>
                                </select>
                            </div>
                            <!-- Job Type -->
                            <div class="form-group">
                                <label for="validatedCustomFile">Job Type</label>
                                <select class="custom-select" name="job_type" required>
                                    <?php
                                    if($result = $this->result["jobType"])
                                    {
                                        foreach ($result as $key => $value)
                                        {
                                            echo "<option value='" .$key. "'>" .$value."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Job location -->
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputCity">City</label>
                                    <input type="text" name="city" class="form-control" id="inputCity" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCity">State</label>
                                    <input type="text" name="state" class="form-control" id="inputCity" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCity">Country</label>
                                    <input type="text" name="country" class="form-control" id="inputCity" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputZip">Zip</label>
                                    <input type="text" name="zip" class="form-control" id="inputZip" required>
                                </div>
                            </div>
                            <!-- Job description -->
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Job Description</label>
                                <textarea class="form-control" name="job_description" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="site-button btn-block btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>