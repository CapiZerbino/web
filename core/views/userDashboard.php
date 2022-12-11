<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container p-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-12">
                    <h2 class="text-uppercase text-center mb-5">User Management</h2>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($_SESSION["result"])) {
                            foreach ($_SESSION["result"] as $user) {
                                echo "
                                    <tr>
                                        <th scope='row'>$user->id</th>
                                        <td>$user->email</td>
                                        <td>$user->user_type_id</td>
                                        <td>$user->registration_date</td>
                                    </tr>
                                    ";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>