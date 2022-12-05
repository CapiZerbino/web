<?php

class RegisterModel extends Model
{
    private string $email;
    private string $password;
    private string $confirm_password;
    private string $role;
    private int $user_type_id;

    public function loadParams($email, $password, $confirm_password, $role)
    {
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->role = $role;
    }

    private function validate(): bool
    {
        // Validate email
        if (empty(trim($this->email))) {
            $this->response["message"] = "Please enter your email";
            return false;
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->response["message"] = "Invalid email format";
            return false;
        }
        // Validate password
        if (empty(trim($this->password))) {
            $this->response["message"] = "Please enter a password.";
            return false;
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $this->response["message"] = "Password must have atleast 6 characters.";
            return false;
        }
        // Validate confirm password
        if (empty(trim($this->confirm_password))) {
            $this->response["message"] = "Please enter a confirm password.";
            return false;
        } else {
            $confirm_password = trim($this->confirm_password);
            if ( ($this->password != $confirm_password)) {
                $this->response["message"] = "Password did not match.";
                return false;
            }
        }
        // Validate gender
        if (empty(trim($this->role))) {
            $this->response["message"] = "Please select your role";
            return false;
        } else {
            if ($this->role == "candidate") {
                $this->user_type_id = 4;
            } else {
                $this->user_type_id = 1;
            }
        }
        return true;
    }

    function executeQuery(string $type)
    {
        // TODO: Implement executeQuery() method.
        if(!$this->validate()) {
            return;
        }
        $sql = "INSERT INTO `user_account` (`id`, `user_type_id`, `email`, `password`, `date_of_birth`, `gender`, `is_active`, `contact_number`, `sms_notification_active`, `email_notification_active`, `user_image`, `registration_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        if($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('iissssisiibs', $param_id, $param_user_type_id, $param_email, $param_password, $param_date_of_birth, $param_gender, $param_is_active, $param_contact_number, $param_sms_notification_active, $param_email_notification_active, $param_user_image, $param_registration_date);

            $param_id = null;
            $param_user_type_id = $this->user_type_id;
            $param_email = $this->email;
            $param_password = md5($this->password);
            $param_date_of_birth = null;
            $param_gender = null;
            $param_is_active = 1;
            $param_contact_number = null;
            $param_sms_notification_active = 1;
            $param_email_notification_active = 1;
            $param_user_image = null;
            $param_registration_date = date('Y-m-d H:i:s');
            if ($stmt->execute()) {
                $this->response["message"] = "OK";
            } else {
                $this->response["message"] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }
}