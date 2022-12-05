<?php

class LoginModel extends Model
{
    private string $email;
    private string $password;
    public function loadParams($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    private function validate(): bool
    {
        if(empty(trim($this->email))) {
            $this->response['message'] = "Please enter your email";
            return false;
        }
        if(empty(trim($this->password))) {
            $this->response['message'] = "Please enter your password";
            return false;
        }
        return true;
    }

    public function executeQuery($type)
    {
        if(!$this->validate())
        {
            return;
        }
        $id = null;
        $user_type_id = null;
        $sql = "SELECT `id`, `email`, `password`, `user_type_id` FROM `user_account` WHERE `email` = ?";
        if($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('s', $this->email);
            if($stmt->execute()) {
                $stmt->store_result();
                if($stmt->num_rows() == 1) {
                    $stmt->bind_result($id, $email, $hashed_password, $user_type_id);
                    if($stmt->fetch()) {
                        if(md5($this->password) == $hashed_password) {
                            $this->response['message'] = 'OK';
                            $this->response['id'] = $id;
                            $this->response['email'] = $email;
                            $this->response['user_type_id'] = $user_type_id;
                        } else {
                            $this->response['message'] = "The password you entered was not valid";
                        }
                    } else {
                        $this->response['message'] = "Oops! Something went wrong. Please try again later.";
                    }
                } else {
                    $this->response['message'] = "No account found with that email.";
                }
            } else {
                $this->response['message'] = "Oops! Something went wrong. Please try again later.";
            }
        }
    }


}
