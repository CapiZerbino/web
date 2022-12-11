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
                                "job_id" => $job[0],
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
                        $job_object = array();
                        foreach ($res["result"] as $job_item) {
                            $job_object[] = (object) [
                                "company_name" => $job_item[1],
                                "company_description" => $job_item[2],
                                "establishment_date" => $job_item[4],
                                "company_url" => $job_item[5],
                            ];
                        }
                        $_SESSION["result"] = $job_object;
                    } else {
                        $_SESSION["message"] = "Cannot found job";
                    }
                }
                $this->view = "findJob";
                break;
            case "apply":
                if(!$_SESSION['logged']) {
                    $this->redirect("login");
                    break;
                } else {
                    if($_SESSION['user_type'] != 'candidate') {
                        echo "dddd";
                        $this->redirect("job/all");
                        break;
                    }
                }
                $query = array_shift($param);
                $user_account_id = $_SESSION["id"];
                if(isset($query) && isset($user_account_id)) {
                    $jobPostActivity = new JobPostActivityModel();
                    $jobPostActivity->loadParams($user_account_id, $query, date('Y-m-d H:i:s'), '');
                    $jobPostActivity->executeQuery("Create");
                    $res = $jobPostActivity->getResponse();
                    if($res["message"] == "OK") {
                        $_SESSION['message'] = "Apply success";
                        $_SESSION['showMessage'] = true;
                        $_SESSION['messageType'] = 'success';
                    } else {
                        $_SESSION['message'] = $res['message'];
                        $_SESSION['showMessage'] = true;
                        $_SESSION['messageType'] = 'danger';
                    }
                    $this->redirect('profile/job-applied');
                }
                break;

            case "create":
                if($_SESSION['logged'] && $_SESSION['user_type'] == 'employee')
                {
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

                            if(isset($company->getResponse()["companyId"])) {
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
                                $res_job = $job->getResponse();
                                if($res_job["message"] == "OK") {
                                    $_SESSION['message'] = "Add job success";
                                    $_SESSION['showMessage'] = true;
                                    $_SESSION['messageType'] = 'success';
                                } else {
                                    $company->executeQuery("RemoveCompany");
                                    $_SESSION['message'] = "Something wrong";
                                    $_SESSION['showMessage'] = true;
                                    $_SESSION['messageType'] = 'error';
//                                    $this->redirect('job/create');
                                }
                            } else {
                                $_SESSION['message'] = "Something wrong";
                                $_SESSION['showMessage'] = true;
                                $_SESSION['messageType'] = 'error';
                            }
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
                } else {
                    $this->redirect("home");
                }
                break;

            default:
                $this->redirect("error");
        }
    }
}
