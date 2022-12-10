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
                $user_account_id = $_SESSION["id"];
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
        $this->view = "myCV";
    }
}