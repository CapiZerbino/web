<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container ">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <h2 class="text-uppercase text-center mb-5">Find a company</h2>
                    <form method="get" action="company/find">
                        <div class="input-group rounded">
                            <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button  type = "submit" class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div>
                        <?php
                        if(isset($_SESSION["result"])) {
                            foreach ($_SESSION["result"] as $company_item) {
                                echo "
                                <div class='card my-3'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$company_item->company_name</h5>
                                        <h6 class='card-subtitle mb-2 text-muted'>$company_item->company_description</h6>
                                        <p class='card-text'>$company_item->establishment_date</p>
                                        <a href='$company_item->company_url' class='card-link'>Visit website</a>
                                    </div>
                                </div>
                                ";
                            }
                        }
                        echo $_SESSION["message"];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>