<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container p-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-12">
                    <h2 class="text-uppercase text-center mb-5">Company Management</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Company name</th>
                                <th scope="col">Company type</th>
                                <th scope="col">Establishment date</th>
                                <th scope="col">Web url</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($_SESSION["result"])) {
                                foreach ($_SESSION["result"] as $company) {
                                    echo "
                                    <tr>
                                        <th scope='row'>$company->id</th>
                                        <td>$company->company_name</td>
                                        <td>$company->company_type</td>
                                        <td>$company->establishment_date</td>
                                        <td>$company->url</td>
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
    </div>
</section>