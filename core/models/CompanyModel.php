<?php
class CompanyModel extends Model
{
    private string $company_name;
    private string $company_description;
    private string $company_image;
    private int $company_type;
    private string $company_url;
    private string $company_establish_date;

    private string $keywords;

    private int $company_id;

    public function loadQuery($query)
    {
        $this->keywords = $query;
    }

    public function loadParams($name, $description, $image, $type, $url, $establish_date)
    {
        $this->company_name = $name;
        $this->company_description = $description;
        $this->company_image = $image;
        $this->company_type = $type;
        $this->company_url = $url;
        $this->company_establish_date = $establish_date;
    }

    public function loadId($id) {
        $this->company_id = $id;
    }

    public function validate(): bool
    {
        // Validate company name
        if (empty(trim($this->company_name))) {
            $this->response["message"] = "Please enter your company name";
            return false;
        }

        // Validate company description
        if (empty(trim($this->company_description))) {
            $this->response["message"] = "Please enter your company description";
            return false;
        }

        // Validate image upload
        // if (isset($_POST["company_image"])) {
        //     $allowed_image_extension = array(
        //         "png",
        //         "jpg",
        //         "jpeg"
        //     );

        //     // Get image file extension
        //     $file_extension = pathinfo($_FILES["company_image"]["name"], PATHINFO_EXTENSION);
        //     // Validate file input is not empty
        //     // function_alert($file_extension);
        //     if (!file_exists($_FILES["company_image"]["tmp_name"])) {
        //         $response = array(
        //             "type" => "error",
        //             "message" => "Choose image file to upload."
        //         );
        //     }
        //     // Validate file input is correct extension
        //     elseif (!in_array($file_extension, $allowed_image_extension)) {
        //         $respon = array(
        //             "type" => "error",
        //             "message" => "Upload valid images. Only PNG and JPEG are allowed."
        //         );
        //     }
        //     // Validate image file size
        //     elseif ($_FILES["company_image"]["size"] > 2000000) {
        //         $response = array(
        //             "type" => "error",
        //             "message" => "Image size exceeds 2MB"
        //         );
        //     } else {
        //         $target = "image/" . basename($_FILES["company_image"]["name"]);
        //         if (move_uploaded_file($_FILES["company_image"]["tmp_name"], $target)) {
        //             $response = array(
        //                 "type" => "success",
        //                 "message" => "Image uploaded successfully."
        //             );
        //         } else {
        //             $response = array(
        //                 "type" => "error",
        //                 "message" => "Problem in uploading image files."
        //             );
        //         }
        //     }
        // }

        // Validate company description
        if (empty(trim($this->company_type))) {
            $this->response["message"] = "Please enter your company type";
            return false;
        }

        // Validate company description
        if (empty(trim($this->company_url))) {
            $this->response["message"] = "Please enter your company url";
            return false;
        }
        return true;
    }

    function executeQuery(string $type)
    {
        // TODO: Implement executeQuery() method.
        switch ($type)
        {
            case "GetCompany":
                $this->getCompany();
                break;
            case "AddCompany":
                $this->addCompany();
                break;
            case "SearchCompany":
                $this->searchCompany();
                break;
            case "ViewCompanyDetail":
                $this->viewCompanyDetail();
                break;
            case "GetCompanyById":
                $this->getCompanyById();
                break;
            default:
                break;
        }
    }

    private function searchCompany()
    {
        $keywords = explode(' ', $this->keywords);
        $searchTermKeywords = array();
        foreach ($keywords as $word)
        {
            $searchTermKeywords[] = "`company_name` LIKE '%$word%'";
        }
        $sql = "SELECT * FROM `company` WHERE " .implode(' AND ', $searchTermKeywords);
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }

    private function viewCompanyDetail()
    {
        $sql = "SELECT * FROM `company` WHERE `id` =" .$this->company_id;
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }

    private function addCompany()
    {
        if(!$this->validate())
        {
            return;
        }
        $sql = "INSERT INTO `company` (`id`, `company_name`, `profile_description`, `business_stream_id`, `establishment_date`, `company_website_url`) VALUES (?,?,?,?,?,?);";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('ississ', $param_id, $param_company_name, $param_company_description, $param_business_stream_id, $param_establishment_date, $param_company_website_url);
            $param_id = null;
            $param_company_name = $this->company_name;
            $param_company_description = $this->company_description;
            $param_business_stream_id = $this->company_type;
            $param_company_website_url = $this->company_url;
            $param_establishment_date = $this->company_establish_date;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
                $this->response["companyId"] = $this->db_instance->insert_id;
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }

    }

    private function getCompany()
    {

    }

    private function getCompanyById()
    {
        $sql = "SELECT * FROM `company` WHERE `id` = " .$this->company_id;
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }

    public function addImage(int $company_id, string $company_image)
    {
        $sql = "INSERT INTO `company` (`id`, `company_id`, `company_image`) VALUES (?,?,?);";
        if($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('iis', $param_id, $param_company_id, $param_company_image);
            $param_id = null;
            $param_company_id = $company_id;
            $param_company_image = $company_image;
            if($stmt->execute()) {
                $this->response['message'] = 'OK';
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    public function getCompanyStream(): array
    {
        $sql = "SELECT * FROM `business_stream`";
        if($stmt = $this->db_instance->prepare($sql))
        {
            if($stmt->execute()){
                $stmt->store_result();
                $result = array();
                $num_row = $stmt->num_rows();
                while($num_row >= 1) {
                    $stmt->bind_result($business_stream_id, $company_stream_name);
                    if($stmt->fetch()) {
                        $result[$business_stream_id] = $company_stream_name;
                    }
                    $num_row = $num_row - 1;
                }
                return $result;
            }
        }
        return [];
    }
}
