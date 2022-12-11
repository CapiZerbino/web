<?php
class ExperienceDetailModel extends Model
{
    private int $user_account_id;
    private string $is_current_job;
    private string $start_date;
    private string $end_date;
    private string $job_title;
    private string $company_name;
    private string $job_location_city;
    private string $job_location_state;
    private string $job_location_country;
    private string $description;

    public function loadQuery($user_account_id)
    {
        $this->user_account_id = $user_account_id;
    }

    public function loadParams($user_account_id, $is_current_job, $start_date, $end_date, $job_title, $company_name,$job_location_city , $job_location_state,$job_location_country ,$description )
    {
        $this->user_account_id = $user_account_id;
        $this->is_current_job = $is_current_job;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->job_title = $job_title;
        $this->company_name = $company_name;
        $this->job_location_city = $job_location_city;
        $this->job_location_state = $job_location_state;
        $this->job_location_country = $job_location_country;
        $this->description = $description;
    }

    public function validate(): bool
    {
        if (empty(trim($this->company_name))) {
            $this->response["message"] = "Please enter your company name";
            return false;
        }
        if (empty(trim($this->job_title))) {
            $this->response["message"] = "Please enter your job title";
            return false;
        }
        if (empty(trim($this->description))) {
            $this->response["message"] = "Please enter your description";
            return false;
        }
        if (empty(trim($this->start_date))) {
            $this->response["message"] = "Please enter your start date";
            return false;
        }
        if (empty(trim($this->end_date))) {
            $this->response["message"] = "Please enter your end date";
            return false;
        }
        return true;
    }

    function executeQuery(string $type)
    {
        // TODO: Implement executeQuery() method.
        switch ($type)
        {
            case "Create":
                $this->createExperience();
                break;
            case "Update":
                $this->updateExperience();
                break;
            case "GetById":
                $this->getExperienceById();
                break;
            default:
                break;
        }
    }

    private function createExperience()
    {
        if(!$this->validate()) {
            return;
        }
        $sql = "INSERT INTO `experience_detail` (`user_account_id`, `is_current_job`, `start_date`, `end_date`, `job_title`, `company_name`, `job_location_city`, `job_location_state`, `job_location_country`, `description`) VALUES (?,?,?,?,?,?,?,?,?,?);";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('isssssssss', $param_user_account_id, $param_is_current_job, $param_start_date, $param_end_date, $param_job_title, $param_company_name, $param_job_location_city, $param_job_location_state, $param_job_location_country, $param_description );
            $param_user_account_id = $this->user_account_id;
            $param_is_current_job = $this->is_current_job;
            $param_start_date = $this->start_date;
            $param_end_date = $this->end_date;
            $param_job_title = $this->job_title;
            $param_company_name = $this->company_name;
            $param_job_location_city = $this->job_location_city;
            $param_job_location_state = $this->job_location_state;
            $param_job_location_country = $this->job_location_country;
            $param_description = $this->description;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    private function updateExperience()
    {
        if(!$this->validate()) {
            return;
        }
        $sql = "UPDATE `experience_detail` SET `company_name` = ?, `job_title` = ?, `description` = ?, `start_date` = ?, `end_date` = ?  WHERE `experience_detail`.`user_account_id` = ?;";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('sssssi',   $param_company_name, $param_job_title,$param_description, $param_start_date, $param_end_date, $param_user_account_id);
            $param_user_account_id = $this->user_account_id;
            $param_start_date = $this->start_date;
            $param_end_date = $this->end_date;
            $param_job_title = $this->job_title;
            $param_company_name = $this->company_name;
            $param_description = $this->description;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    private function getExperienceById()
    {
        $sql = "SELECT * FROM `experience_detail` WHERE `user_account_id` = " .$this->user_account_id;
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }
}