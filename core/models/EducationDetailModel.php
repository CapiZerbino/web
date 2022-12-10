<?php
class EducationDetailModel extends Model
{

    private int $user_account_id;
    private string $certificate_degree_name;
    private string $major;
    private string $Institute_university_name;
    private string $starting_date;
    private string $completion_date;
    private float $percentage;
    private float $cgpa;

    public function loadParams($user_account_id, $certificate_degree_name, $major, $Institute_university_name, $starting_date, $completion_date,$percentage , $cgpa)
    {
        $this->user_account_id = $user_account_id;
        $this->certificate_degree_name = $certificate_degree_name;
        $this->major = $major;
        $this->Institute_university_name = $Institute_university_name;
        $this->starting_date = $starting_date;
        $this->completion_date = $completion_date;
        $this->percentage = $percentage;
        $this->cgpa = $cgpa;
    }

    public function validate(): bool
    {
        if (empty(trim($this->certificate_degree_name))) {
            $this->response["message"] = "Please enter your type certificate";
            return false;
        }
        if (empty(trim($this->major))) {
            $this->response["message"] = "Please enter your major";
            return false;
        }
        if (empty(trim($this->Institute_university_name))) {
            $this->response["message"] = "Please enter your school name";
            return false;
        }
        if (empty(trim($this->starting_date))) {
            $this->response["message"] = "Please enter your start date";
            return false;
        }
        if (empty(trim($this->completion_date))) {
            $this->response["message"] = "Please enter your completion date";
            return false;
        }
        if (empty(trim($this->cgpa))) {
            $this->response["message"] = "Please enter your GPA";
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
                $this->createEducation();
                break;
            case "Update":
                $this->updateEducation();
                break;
            case "GetById":
                $this->getEducationById();
                break;
            default:
                break;
        }
    }

    private function createEducation()
    {
        if(!$this->validate()) {
            return;
        }
        $sql = "INSERT INTO `education_detail` (`user_account_id`, `certificate_degree_name`, `major`, `Institute_university_name`, `starting_date`, `completion_date`, `percentage`, `cgpa`) VALUES (?,?,?,?,?,?,?,?);";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('isssssii', $param_user_account_id, $param_certificate_degree_name, $param_major, $param_Institute_university_name, $param_starting_date, $param_completion_date, $param_percentage, $param_cgpa);
            $param_user_account_id = $this->user_account_id;
            $param_certificate_degree_name = $this->certificate_degree_name;
            $param_major = $this->major;
            $param_Institute_university_name = $this->Institute_university_name;
            $param_starting_date = $this->starting_date;
            $param_completion_date = $this->completion_date;
            $param_percentage = $this->percentage;
            $param_cgpa = $this->cgpa;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    private function updateEducation()
    {
        if(!$this->validate()) {
            return;
        }
        $sql = "UPDATE `education_detail` SET `certificate_degree_name` = ?, `major` = ?, `Institute_university_name` = ?, `starting_date` = ?,`completion_date` = ?, `cgpa` = ? WHERE `education_detail`.`user_account_id` = ?;";

        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('sssssii', $param_certificate_degree_name, $param_major, $param_Institute_university_name, $param_starting_date, $param_completion_date, $param_cgpa, $param_user_account_id);
            $param_certificate_degree_name = $this->certificate_degree_name;
            $param_major = $this->major;
            $param_Institute_university_name = $this->Institute_university_name;
            $param_starting_date = $this->starting_date;
            $param_completion_date = $this->completion_date;
            $param_cgpa = $this->cgpa;
            $param_user_account_id = $this->user_account_id;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    private function getEducationById()
    {
        $sql = "SELECT * FROM `education_detail` WHERE `user_account_id` = " .$this->user_account_id;
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }
}