<?php
class JobModel extends Model
{
    private int $id;
    private int $posted_by_id;
    private int $job_type_id;
    private int $company_id;
    private bool $is_company_name_hidden;
    private string $created_date;
    private string $job_description;
    private int $job_location_id;
    private bool $is_active;

    private string $keyword;

    public function loadQuery($id)
    {
        $this->id = $id;
    }

    public function loadParams($posted_by_id, $job_type_id, $company_id, $is_company_name_hidden, $job_description, $job_location_id, $is_active)
    {
        $this->posted_by_id = $posted_by_id;
        $this->job_type_id = $job_type_id;
        $this->company_id = $company_id;
        $this->is_company_name_hidden = $is_company_name_hidden;
        $this->created_date = date('Y-m-d H:i:s');
        $this->job_description = $job_description;
        $this->job_location_id = $job_location_id;
        $this->is_active = $is_active;

    }

    public function validate() : bool
    {
        if (empty(trim($this->job_description))) {
            $this->response["message"] = "Please enter your company name";
            return false;
        }
        if (empty(trim($this->job_location_id))) {
            $this->response["message"] = "Fail to load job location id";
            return false;
        }
        if (empty(trim($this->company_id))) {
            $this->response["message"] = "Fail to load company id";
            return false;
        }
        if (empty(trim($this->job_type_id))) {
            $this->response["message"] = "Please enter your job type";
            return false;
        }
        if (empty(trim($this->posted_by_id))) {
            $this->response["message"] = "Fail to get user id";
            return false;
        }
        return true;
    }

    function executeQuery(string $type)
    {
        switch ($type) {
            case "AddJob":
                $this->addJob();
                break;
            case "SearchJob":
                $this->searchJob();
                break;
            case "GetAllJob":
                $this->getJob();
                break;
            case "GetJobById":
                $this->getJobById();
                break;
            default:
                break;
        }
        // TODO: Implement executeQuery() method.
    }

    private function getJob()
    {
        $sql = "SELECT * FROM `job_post`";
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }

    private function searchJob()
    {
//        $keywords = explode(' ', $this->keyword);
//        $searchTermKeywords = array();
//        foreach ($keywords as $word)
//        {
//            $searchTermKeywords[] = ""
//        }

    }

    private function getJobById()
    {
        $sql = "SELECT * FROM `job_post` WHERE `id` = " .$this->id;
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }

    private function addJob()
    {
        if(!$this->validate())
        {
            return;
        }
        $sql = "INSERT INTO `job_post` (`id`, `posted_by_id`, `job_type_id`, `company_id`, `is_company_name_hidden`, `created_date`, `job_description`, `job_location_id`, `is_active`) VALUES (?,?,?,?,?,?,?,?,?);";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('iiiiissii', $param_id, $param_posted_by_id, $param_job_type_id, $param_company_id, $param_is_company_name_hidden, $param_created_date, $param_job_description, $param_job_location_id, $param_is_active);
            $param_id = null;
            $param_posted_by_id = $this->posted_by_id;
            $param_job_type_id = $this->job_type_id;
            $param_company_id = $this->company_id;
            $param_is_company_name_hidden = $this->is_company_name_hidden;
            $param_created_date = $this->created_date;
            $param_job_description = $this->job_description;
            $param_job_location_id = $this->job_location_id;
            $param_is_active = $this->is_active;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
                $this->response["jobId"] = $this->db_instance->insert_id;
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        } else {
            $this->response['message'] = "Oops! Something went wrong. Please try again later.";
        }

    }

    private function updateJob()
    {

    }

    public function getJobType():array
    {
        $sql = "SELECT * FROM `job_type`";
        if ($stmt = mysqli_prepare($this->db_instance, $sql)) {
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $result = array();
                $num_row = mysqli_stmt_num_rows($stmt);
                while ($num_row >= 1) {
                    mysqli_stmt_bind_result($stmt, $job_type_id, $job_type_name);
                    if (mysqli_stmt_fetch($stmt)) {
                        $result[$job_type_id] = $job_type_name;
                    }
                    $num_row = $num_row - 1;
                }
                return $result;
            }
        }
        return [];
    }



}