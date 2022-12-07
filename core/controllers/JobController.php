<?php
class JobController extends Controller
{

    function process($param)
    {
        // TODO: Implement process() method.
        $action = array_shift($param);
        switch ($action)
        {
            case "":
                break;
            case "all":
                $this->view = "allJob";
                $job = new JobModel();
                $job->executeQuery("GetAllJob");
                $res_job = $job->getResponse();
                if(!empty($res_job["result"])) {
                    $res = array();
                    foreach ($res_job["result"] as $job) {
                        $company_id = $job[2];
                        $company = new CompanyModel();
                        $company->loadId($company_id);
                        $company->executeQuery("GetCompanyById");
                        $res_company = $company->getResponse();
                        if(!empty($res_company["result"])) {
                            $res[] = (object)[
                                "company_name" => $res_company["result"][0][1],
                                "job_description" => $job[6],
                                "created_date" => $job[5],
                            ];
                        }
                    }
                    $_SESSION["result"] = $res;
                } else {
                    $this->view = 'allJob';
                }
                break;
            case "find":
                header("HTTP/1.0 200");
                $this->header["title"] = "Find Job Page";
                $this->header["description"] = "Find a job";
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
                    $job = new JobModel();
                    $job->loadQuery($_GET["search"]);
                    $job->executeQuery("SearchJob");
                    $res = $job->getResponse();
                    if(!empty($res["result"]))
                    {
                        $_SESSION["result"] = $res["result"];
                    } else {
                        $_SESSION["message"] = "Cannot found job";
                    }
                }
                $this->view = "findJob";
                break;
            case "create":
                if(!$_SESSION['logged'])
                {
                    $this->redirect("home");
                }
                header("HTTP/1.0 200");
                $this->header["title"] = "Create A Job Description Page";
                $this->header["description"] = "Create A Job Description";

                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $company = new CompanyModel();
                    $job = new JobModel();
                    $location = new LocationModel();

                    $company->loadParams($_POST["company_name"], $_POST["company_description"], $_POST["company_image"], $_POST["company_type"], $_POST["company_url"], $_POST["company_establish_date"]);
                    $location->loadParams($_POST["address"], $_POST["city"], $_POST["state"], $_POST["country"], $_POST["zip"]);

                    $isValidCompany = $company->validate();
                    $isValidLocation = $location->validate();

                    if($isValidCompany && $isValidLocation) {
                        $company->executeQuery("AddCompany");
                        $location->executeQuery("AddLocation");
                        $job->loadParams(
                            $_SESSION["id"],
                            $_POST["job_type"],
                            $company->getResponse()["companyId"],
                            false,
                            $_POST["job_description"],
                            $location->getResponse()["locationId"],
                            true
                        );
                        $job->executeQuery("AddJob");
                    }
                } else {
                    $this->company = new CompanyModel();
                    $this->skill = new SkillModel();
                    $this->job = new JobModel();
                    $this->result["companyType"] = $this->company->getCompanyStream();
                    $this->result["skillSet"] = $this->skill->getSkillSet();
                    $this->result["jobType"] = $this->job->getJobType();
                    $this->view = "createJobDescription";
                }
                break;
            default:
                $this->redirect("error");
        }
    }
}
