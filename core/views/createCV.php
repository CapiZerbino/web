<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container p-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="p-3 mb-3  bg-light text-dark">
                        <h5 class="text-uppercase text-center fw6 m-0">Update profile</h5>
                    </div>
                    <form method="post" action="profile/update">
                        <div class="form-row mb-4">
                            <!-- First Name -->
                            <div class="form-outline col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control form-control-md" required />
                            </div>
                            <!-- First Name -->
                            <div class="form-outline col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control form-control-md" required />
                            </div>
                        </div>
                        <!-- Current Salary -->
                        <div class="form-outline mb-4">
                            <label class="form-label">Current Salary</label>
                            <input type="number" name="current_salary" class="form-control form-control-md" required />
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="submit_profile" class="site-button btn-block btn-lg">Save</button>
                        </div>
                    </form>

                    <div class="p-3 mb-3  bg-light text-dark">
                        <h5 class="text-uppercase text-center fw6 m-0">Update education</h5>
                    </div>
                    <form method="post" action="profile/update">
                        <!-- First Name -->
                        <div class="form-group mb-4">
                            <label for="validatedCustomFile">Certificate Degree Type</label>
                            <select class="custom-select" name="certificate_degree_name" required>
                                <option value="University">University</option>
                                <option value="College">College</option>
                                <option value="High School">High School</option>
                            </select>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">Major</label>
                            <input type="text" name="major" class="form-control form-control-md" required/>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">School Name</label>
                            <input type="text" name="Institute_university_name" class="form-control form-control-md" required/>
                        </div>

                        <div class="form-row mb-4">
                            <!-- Starting day -->
                            <div class="form-outline col-md-6">
                                <label for="validationCustom03">Start day</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="starting_date" class="form-control form-control-md" id="date" required/>
                                </div>
                            </div>
                            <!-- Completion day -->
                            <div class="form-outline col-md-6">
                                <label for="validationCustom03">Completion day</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="completion_date" class="form-control form-control-md" id="date" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label">GPA</label>
                            <input type="number" name="cgpa" class="form-control form-control-md" required/>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="submit_education" class="site-button btn-block btn-lg"">Save</button>
                        </div>
                    </form>

                    <div class="p-3 mb-3  bg-light text-dark">
                        <h5 class="text-uppercase text-center fw6 m-0">Update experience</h5>
                    </div>
                    <form method="post" action="profile/update">
                        <!-- First Name -->
                        <div class="form-outline mb-4">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control form-control-md" />
                        </div>
                        <!-- Job Title -->
                        <div class="form-group mb-4">
                            <label for="exampleFormControlTextarea1">Job Title</label>
                            <input type="text" name="job_title" class="form-control form-control-md" />
                        </div>
                        <!-- Job description -->
                        <div class="form-group mb-4">
                            <label for="exampleFormControlTextarea1">Job Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="form-row mb-4">
                            <!-- Starting day -->
                            <div class="form-outline col-md-6">
                                <label for="validationCustom03">Start day</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="start_date" class="form-control form-control-md" id="date" />
                                </div>
                            </div>
                            <!-- Completion day -->
                            <div class="form-outline col-md-6">
                                <label for="validationCustom03">End day</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="end_date" class="form-control form-control-md" id="date" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="submit_experience" class="site-button btn-block btn-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>