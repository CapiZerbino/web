<?php
class ProfileController extends Controller
{

    function process($param)
    {
        // TODO: Implement process() method.
        $action = array_shift($param);
        switch ($action)
        {
            case "":
                break;
            case "job-applied":
                header("HTTP/1.0 200");
                $this->header["title"] = "View Job Applied Page";
                $this->header["description"] = "View Job Applied";
                $user_account_id = $_SESSION["id"];
                $job_post_activity = new JobPostActivityModel();
                $job_post_activity->loadQuery($user_account_id);
                $job_post_activity->executeQuery("GetByUserAccountId");
                $res = $job_post_activity->getResponse();
                if(!empty($res["result"])) {
                    $job_applied = array();
                    foreach ($res["result"] as $job_post_activity) {
                        $job_post_id = $job_post_activity[1];
                        $job = new JobModel();
                        $job->loadQuery($job_post_id);
                        $job->executeQuery("GetJobById");
                        $res_job = $job->getResponse();
                        if(!empty($res_job["result"])) {
                            $company_id = $res_job["result"][0][3];
                            $company = new CompanyModel();
                            $company->loadId($company_id);
                            $company->executeQuery("GetCompanyById");
                            $res_company = $company->getResponse();
                            if(!empty($res_company["result"])) {
                                $company_name = $res_company["result"][0][1];
                                $company_description = $res_company["result"][0][2];
                                $job_description = $res_job["result"][0][6];
                                $apply_date = $res["result"][0][2];
                                $job_applied[] = (object)[
                                    "company_name" => $company_name,
                                    "company_description" => $company_description,
                                    "job_description" => $job_description,
                                    "apply_date" => $apply_date,
                                ];

                            }
                        }
                    }
                    $_SESSION["job_applied"] = $job_applied;
                } else {
                    $_SESSION["message"] = "Cannot found job";
                }
                $this->view = "viewApply";
                break;
            case "create":
                header("HTTP/1.0 200");
                $this->header["title"] = "Create CV Page";
                $this->header["description"] = "Create a CV";
                if($_SERVER["REQUEST_METHOD"] == "POST") {

                } else {
                    $this->view = "createCV";
                }
                break;
            case "view":
                $this->header["title"] = "My CV Page";
                $this->header["description"] = "View my CV";
                if($_SESSION["user_type"] == 'employee') {
                    $user_account_id = array_shift($param);
                } else {
                    $user_account_id = $_SESSION["id"];
                }
                $this->handleGetCV($user_account_id);
                break;
            case "update":
                $this->header["title"] = "Update CV Page";
                $this->header["description"] = "Update my CV";
                $user_account_id = $_SESSION["id"];
                echo $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_education"]);
                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_profile"])) {
                    $this->handleProfile($user_account_id);
                } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_education"])) {
                    $this->handleEducation($user_account_id);
                } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_experience"])) {
                    $this->handleExperience($user_account_id);
                } else {
                    $this->view = "createCV";
                }
                break;
            default:
                break;
        }

    }

    private function handleProfile($user_account_id)
    {
        $profile = new SeekerProfileModel();
        $profile->loadParams($user_account_id, $_POST["first_name"], $_POST["last_name"], $_POST["current_salary"], true, 'VND');
        $isValid = $profile->validate();
        $res = $profile->getResponse();

        if(!$isValid) {
            $_SESSION["message"] = $res["message"];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->view = 'createCV';
            return;
        }
        $profile->executeQuery("GetById");
        $res = $profile->getResponse();
        if(!empty($res["result"])) {
            $profile->executeQuery("Update");
            $res_update = $profile->getResponse();
            if($res_update["message"] === "OK") {
                $_SESSION["message"] = "Update your CV success";
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'success';
                $this->redirect("profile/view");
            } else {
                $_SESSION["message"] = $res_update["message"];
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'danger';
                $this->view = "createCV";
            }
        } else {
            $profile->executeQuery("Create");
            $res_create = $profile->getResponse();
            if($res_create["message"] === "OK") {
                $_SESSION["message"] = "Create your CV success";
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'success';
                $this->redirect("profile/view");
            } else {
                $_SESSION["message"] = $res_create["message"];
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'danger';
                $this->view = "createCV";
            }
        }
    }

    private function handleEducation($user_account_id)
    {
        $education = new EducationDetailModel();
        $education->loadParams($user_account_id, $_POST["certificate_degree_name"], $_POST["major"], $_POST["Institute_university_name"], $_POST["starting_date"], $_POST["completion_date"],  0,  $_POST["cgpa"]);
        $isValid = $education->validate();
        $res = $education->getResponse();

        if(!$isValid) {
            $_SESSION["message"] = $res["message"];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->view = 'createCV';
            return;
        }
        $education->executeQuery("GetById");
        $res = $education->getResponse();

        if(!empty($res["result"])) {
            $education->executeQuery("Update");
            $res_update = $education->getResponse();
            print_r($res_update);
            if($res_update["message"] === "OK") {
                $_SESSION["message"] = "Update your CV success";
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'success';
                $this->redirect("profile/view");
            } else {
                $_SESSION["message"] = $res_update["message"];
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'danger';
                $this->view = "createCV";
            }
        } else {
            $education->executeQuery("Create");
            $res_create = $education->getResponse();
            if($res_create["message"] === "OK") {
                $_SESSION["message"] = "Create your CV success";
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'success';
                $this->redirect("profile/view");
            } else {
                $_SESSION["message"] = $res_create["message"];
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'danger';
                $this->view = "createCV";
            }
        }
    }

    private function handleExperience($user_account_id)
    {
        $experience = new ExperienceDetailModel();
        $experience->loadParams($user_account_id, true, $_POST["start_date"], $_POST["end_date"], $_POST["job_title"],  $_POST["company_name"],'', '', '', $_POST['description']);
        $isValid = $experience->validate();
        $res = $experience->getResponse();

        if(!$isValid) {
            $_SESSION["message"] = $res["message"];
            $_SESSION['showMessage'] = true;
            $_SESSION['messageType'] = 'danger';
            $this->view = 'createCV';
            return;
        }
        $experience->executeQuery("GetById");
        $res = $experience->getResponse();
        if(!empty($res["result"])) {
            $experience->executeQuery("Update");
            $res_update = $experience->getResponse();
            if($res_update["message"] === "OK") {
                $_SESSION["message"] = "Update your CV success";
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'success';
                $this->redirect("profile/view");
            } else {
                $_SESSION["message"] = $res_update["message"];
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'danger';
                $this->view = "createCV";
            }
        } else {
            $experience->executeQuery("Create");
            $res_create = $experience->getResponse();
            if($res_create["message"] === "OK") {
                $_SESSION["message"] = "Create your CV success";
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'success';
                $this->redirect("profile/view");
            } else {
                $_SESSION["message"] = $res_create["message"];
                $_SESSION['showMessage'] = true;
                $_SESSION['messageType'] = 'danger';
                $this->view = "createCV";
            }
        }
    }

    private function handleGetCV($user_account_id)
    {
        $profile = new SeekerProfileModel();
        $education = new EducationDetailModel();
        $experience = new ExperienceDetailModel();
        $profile->loadQuery($user_account_id);
        $education->loadQuery($user_account_id);
        $experience->loadQuery($user_account_id);

        $profile->executeQuery("GetById");
        $res_profile = $profile->getResponse();
        $education->executeQuery("GetById");
        $res_education = $education->getResponse();
        $experience->executeQuery("GetById");
        $res_experience = $experience->getResponse();


        $object_profile = array();
        foreach ($res_profile["result"] as $profile_item) {
            $object_profile[] = (object)[
                "first_name" => $profile_item[1],
                "last_name" => $profile_item[2],
                "current_salary" => $profile_item[3],
            ];
        }
        $object_education = array();
        foreach ($res_education["result"] as $education_item) {
            $object_education[] = (object)[
                "certificate_degree_name" => $education_item[1],
                "major" => $education_item[2],
                "Institute_university_name" => $education_item[3],
                "starting_date" => $education_item[4],
                "completion_date" => $education_item[5],
                "cgpa" => $education_item[7],
            ];
        }
        $object_experience = array();
        foreach ($res_experience["result"] as $experience_item) {
            $object_experience[] = (object)[
                "start_date" => $experience_item[2],
                "end_date" => $experience_item[3],
                "job_title" => $experience_item[4],
                "company_name" => $experience_item[5],
                "description" => $experience_item[9],
            ];
        }
        $_SESSION["res_profile"] = $object_profile;
        $_SESSION["res_education"] = $object_education;
        $_SESSION["res_experience"] = $object_experience;

        $this->view = "myCV";
    }
}