<?php

class CreateJobDescriptionController extends Controller
{
    private CompanyModel $company;

    function process($param)
    {
        // TODO: Implement process() method.
        if(!$_SESSION['logged'])
        {
            $this->redirect("home");
        }
        header("HTTP/1.0 200");
        $this->header["title"] = "Create A Job Description Pagse";
        $this->header["description"] = "Create A Job Description";
        $action = array_shift($param);
        switch ($action)
        {
            case "":
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
