<section class="vh-100 bg-white">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container p-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <h2 class="text-uppercase text-center mb-5">Find a company</h2>
                    <form method="get" action="findCompany">
                        <div class="input-group rounded">
                            <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button  type = "submit" class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div>
                        <?php
                        if(!empty($_SESSION["result"])) {
                            foreach ($_SESSION["result"] as $key => $value) {
                                echo "
                                <div class='card my-3'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$value[1]</h5>
                                        <h6 class='card-subtitle mb-2 text-muted'>$value[3]</h6>
                                        <p class='card-text'>$value[2]</p>
                                        <a href='$value[4]' class='card-link'>View detail</a>
                                        <a href='$value[4]' class='card-link'>Visit website</a>
                                    </div>
                                </div>
                                ";
                            }
                        } else {
                            echo $_SESSION["message"];
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>