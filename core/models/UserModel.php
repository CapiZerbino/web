<?php
class UserModel extends Model
{

    private int $id;
    private int $user_type_id;
    private string $email;
    private string $password;
    private string $date_of_birth;
    private string $gender;
    private bool $is_active;
    private string $contact_number;
    private bool $sms_notification_active;
    private bool $email_notification_active;
    private string $user_image;
    private string $registration_date;

    function executeQuery(string $type)
    {
        // TODO: Implement executeQuery() method.
        switch ($type)
        {
            case "GetAllUser":
                $this->getAllUser();
                break;
            default:
                break;

        }
    }

    public function getUserType($user_type_id): string
    {
        $sql = "SELECT `user_type_name` FROM `user_type` WHERE `id` = ".$user_type_id;
        $result = $this->db_instance->query($sql)->fetch_all();
        return $result[0][0];
    }

    public function getAllUser()
    {
        $sql = "SELECT * FROM `user_account`";
        $result = $this->db_instance->query($sql);
        $this->response["result"] = $result->fetch_all();
    }

}