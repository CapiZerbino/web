<?php
class JobPostActivityModel extends Model
{
    private int $user_account_id;
    private int $job_post_id;
    private string $apply_date;
    private string $cv_file;

    public function loadParams($user_account_id, $job_post_id, $apply_date, $cv_file)
    {
        $this->user_account_id = $user_account_id;
        $this->job_post_id = $job_post_id;
        $this->apply_date = $apply_date;
        $this->cv_file = $cv_file;
    }

    public function loadQuery($user_account_id)
    {
        $this->user_account_id = $user_account_id;
    }

    public function loadPostId($job_post_id)
    {
        $this->job_post_id = $job_post_id;
    }


    function executeQuery(string $type)
    {
        // TODO: Implement executeQuery() method.
        switch ($type)
        {
            case "Create":
                $this->createJobApply();
                break;
            case "GetByUserAccountId":
                $this->getJobApplyByUserAccount();
                break;
            case "GetByPostId":
                $this->getByPostId();
                break;
            default:
                break;
        }
    }

    private function createJobApply()
    {
        $sql = "INSERT INTO `job_post_activity` (`user_account_id`, `job_post_id`, `apply_date`, `cv_file`) VALUES (?,?,?,?);";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('iisb', $param_user_account_id, $param_job_post_id, $param_apply_date, $param_cv_file);
            $param_user_account_id = $this->user_account_id;
            $param_job_post_id = $this->job_post_id;
            $param_apply_date = $this->apply_date;
            $param_cv_file = $this->param_cv_file;

            if($stmt->execute()) {
                $this->response["message"] = "OK";
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    private function getJobApplyByUserAccount()
    {
        $sql = "SELECT * FROM `job_post_activity` WHERE `user_account_id` =" .$this->user_account_id;
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }

    private function getByPostId()
    {
        $sql = "SELECT * FROM `job_post_activity` WHERE `job_post_id` =" .$this->job_post_id;
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }
}