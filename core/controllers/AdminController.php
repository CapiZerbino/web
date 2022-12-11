<?php
class AdminController extends Controller
{

    function process($param)
    {
        // TODO: Implement process() method.
        $action = array_shift($param);
        if(isset($_SESSION["id"]) && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == 'admin')
        {
            switch ($action)
            {
                case "":
                    $user = new UserModel();
                    $user->executeQuery("GetAllUser");
                    $res_user = $user->getResponse();
                    $company = new CompanyModel();
                    $company->executeQuery("GetAllCompany");
                    $res_company = $company->getResponse();
                    $company_stream = $company->getCompanyStream();
                    $job = new JobModel();
                    $job->executeQuery("GetAllJob");
                    $res_job = $job->getResponse();

                    $_SESSION["result"] = (object)[
                        "total_user" => count($res_user["result"]),
                        "total_company" => count($res_company["result"]),
                        "total_company_stream" => count($company_stream),
                        "total_job_post" => count($res_job)
                    ];
                    $this->view = 'admin';
                    break;
                case "user-management":
                    $user = new UserModel();
                    $user->executeQuery("GetAllUser");
                    $res = $user->getResponse();
                    if(!empty($res["result"])) {
                        $user_object = array();
                        foreach ($res["result"] as $user_item) {
                            $user_object[] = (object) [
                                "id"=> $user_item[0],
                                "user_type_id" => $user->getUserType($user_item[1]),
                                "email" => $user_item[2],
                                "registration_date" => $user_item[11],
                            ];
                        }
                        $_SESSION["result"] = $user_object;
                    }
                    $this->view = "userDashboard";
                    break;
                case "company-management":
                    $company = new CompanyModel();
                    $company->executeQuery("GetAllCompany");
                    $res = $company->getResponse();
                    if(!empty($res["result"])) {
                        $company_object = array();
                        foreach ($res["result"] as $company_item) {
                            $company_object[] = (object) [
                                "id"=> $company_item[0],
                                "company_name" => $company_item[1],
                                "company_type" => $company->getCompanyStreamById($company_item[3]),
                                "establishment_date" => $company_item[4],
                                "url" => $company_item[5],
                            ];
                        }
                        $_SESSION["result"] = $company_object;

                    }
                    $this->view = "companyDashboard";
                    break;
            }
        } else {
            $this->redirect('home');
        }
    }
}