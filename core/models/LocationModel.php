<?php
class LocationModel extends Model
{
    private int $id;
    private string $street_address;
    private string $city;
    private string $state;
    private string $country;
    private string $zip;

    public function loadParams ($street_address, $city, $state, $country, $zip)
    {
        $this->street_address = $street_address;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->zip = $zip;
    }

    public function validate():bool
    {
        if (empty(trim($this->street_address))) {
            $this->response["message"] = "Please enter your street address";
            return false;
        }
        if (empty(trim($this->city))) {
            $this->response["message"] = "Please enter your city";
            return false;
        }
        if (empty(trim($this->state))) {
            $this->response["message"] = "Please enter your state";
            return false;
        }
        if (empty(trim($this->country))) {
            $this->response["message"] = "Please enter your country";
            return false;
        }
        if (empty(trim($this->zip))) {
            $this->response["message"] = "Please enter your zip code";
            return false;
        }
        return true;
    }

    function executeQuery(string $type)
    {
        // TODO: Implement executeQuery() method.
        switch ($type)
        {
            case "AddLocation":
                $this->addLocation();
                break;
            default:
                break;
        }
    }

    private function addLocation()
    {
        if(!$this->validate())
        {
            return;
        }
        $sql = "INSERT INTO `job_location` (`id`, `street_address`, `city`, `state`, `country`, `zip`) VALUES (?,?,?,?,?,?);";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('ississ', $param_id, $param_street_address, $param_city, $param_state, $param_country, $param_zip);
            $param_id = null;
            $param_street_address = $this->street_address;
            $param_city = $this->city;
            $param_state = $this->state;
            $param_country = $this->country;
            $param_zip = $this->zip;
            if($stmt->execute()) {
                $this->response["message"] = "OK";
                $this->response["locationId"] = $this->db_instance->insert_id;
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    private function getLocation()
    {

    }

    private function updateLocation()
    {

    }
}