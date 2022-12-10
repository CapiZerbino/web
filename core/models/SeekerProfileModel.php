<?php
class SeekerProfileModel extends Model
{

    private int $user_account_id;
    private string $first_name;
    private string $last_name;
    private float $current_salary;
    private bool $is_annually_monthly;
    private string $currency;

    public function loadParams($user_account_id, $first_name, $last_name, $current_salary, $is_annually_monthly, $currency)
    {
        $this->user_account_id = $user_account_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->current_salary = $current_salary;
        $this->is_annually_monthly = $is_annually_monthly;
        $this->currency = $currency;
    }

    public function validate(): bool
    {
        if (empty(trim($this->first_name))) {
            $this->response["message"] = "Please enter your first name";
            return false;
        }
        if (empty(trim($this->last_name))) {
            $this->response["message"] = "Please enter your last name";
            return false;
        }
        if (empty(trim($this->current_salary))) {
            $this->response["message"] = "Please enter your current salary";
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
                $this->createProfile();
                break;
            case "Update":
                $this->updateProfile();
                break;
            case "GetById":
                $this->getProfileById();
                break;
            default:
                break;
        }

    }

    private function createProfile()
    {
        if(!$this->validate()) {
            return;
        }
        $sql = "INSERT INTO `seeker_profile` (`user_account_id`, `first_name`, `last_name`, `current_salary`, `is_annually_monthly`, `currency`) VALUES (?,?,?,?,?,?);";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('ississ', $param_user_account_id, $param_first_name, $param_last_name, $param_current_salary, $param_is_annually_monthly, $param_currency);
            $param_user_account_id = $this->user_account_id;
            $param_first_name = $this->first_name;
            $param_last_name = $this->last_name;
            $param_current_salary = $this->current_salary;
            $param_is_annually_monthly = $this->is_annually_monthly;
            $param_currency = $this->currency;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    private function updateProfile()
    {
        if(!$this->validate()) {
            return;
        }
        $sql = "UPDATE `seeker_profile` SET `first_name` = ?, `last_name` = ?, `current_salary` = ? WHERE `seeker_profile`.`user_account_id` = ?;";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('ssii', $param_first_name, $param_last_name, $param_current_salary, $param_user_account_id);
            $param_first_name = $this->first_name;
            $param_last_name = $this->last_name;
            $param_current_salary = $this->current_salary;
            $param_user_account_id = $this->user_account_id;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    private function getProfileById()
    {
        $sql = "SELECT * FROM `seeker_profile` WHERE `user_account_id` = " .$this->user_account_id;
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }
}