<?php
class CompanyController extends Controller
{
    function process($param)
    {
        // TODO: Implement process() method.
        $action = array_shift($param);
        switch ($action)
        {
            case "":
                break;
            case "jobs":
                header("HTTP/1.0 200");
                $this->header["title"] = "View Job Page";
                $this->header["description"] = "View Job";
                break;
            case "cv-applied":
                // TODO: view cv apply is just for employee
                if($_SESSION['logged'] && $_SESSION['user_type'] == 'employee') {
                    header("HTTP/1.0 200");
                    $this->header["title"] = "View Job Applied Page";
                    $this->header["description"] = "View Job Applied";
                    $user_id = $_SESSION['id'];
                    $job_post = new JobModel();
                    $result = $job_post->getJobsByUserAccountId($user_id);
                    $job_applied = array();
                    foreach ($result as $job_post_item)
                    {
                        $job_post_id = $job_post_item[0];
                        $job_post_activity = new JobPostActivityModel();
                        $job_post_activity->loadPostId($job_post_id);
                        $job_post_activity->executeQuery("GetByPostId");
                        $res = $job_post_activity->getResponse(); // -> return array of post
                        // TODO: get all user_account_id linked to post
                        if(!empty($res["result"])) {

                            foreach ($res["result"] as $job_post_activity) {
                                $user_account_id = $job_post_activity[0];
                                $user = new UserModel();
                                $result = $user->getUserById($user_account_id);
                                $job_applied[] = (object)[
                                    "user_id"=>$result[0][0],
                                    "email" =>$result[0][2],
                                ];
                            }

                        } else {
                            $_SESSION["message"] = "Cannot found job";
                        }
                    }
                    $_SESSION["job_applied"] = $job_applied;
                    $this->view = "viewCVEmployee";
                } else {
                    $this->redirect('home');
                }

                break;
            case "find":
                // TODO: finding company for all type of user
                header("HTTP/1.0 200");
                $this->header["title"] = "Find Company Page";
                $this->header["description"] = "Find a company";
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
                    $_SESSION["result"] = null;
                    $_SESSION["message"] = null;
                    $company = new CompanyModel();
                    $company->loadQuery($_GET["search"]);
                    $company->executeQuery("SearchCompany");
                    $res = $company->getResponse();
                    if(!empty($res["result"]))
                    {
                        $company_object = array();
                        foreach ($res["result"] as $company_item) {
                            $company_object[] = (object) [
                              "company_name" => $company_item[1],
                                "company_description" => $company_item[2],
                                "establishment_date" => $company_item[4],
                                "company_url" => $company_item[5],
                            ];
                        }
                        $_SESSION["result"] = $company_object;
                    } else {
                        $_SESSION["message"] = "Cannot found company";
                    }
                } else {
                    $_SESSION["result"] = null;
                    $_SESSION["message"] = null;
                }
                $this->view = "findCompany";
                break;
            default:
                $this->redirect("error");
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