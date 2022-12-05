<section class="vh-100 bg-white">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                                <form method="post" action="register">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                        <input type="email" id="form3Example3cg" name="email"
                                            class="form-control form-control-md" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                        <input type="password" id="form3Example4cg" name="password"
                                            class="form-control form-control-md" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                        <input type="password" id="form3Example4cdg" name="confirm_password"
                                            class="form-control form-control-md" />
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="validatedCustomFile">Role</label>
                                        <select class="custom-select" name="role" required>
                                            <option value="candidate">Candidate</option>
                                            <option value="employee">Employee</option>
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a
                                            href="login" class="fw-bold text-body"><u>Login here</u></a></p>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>