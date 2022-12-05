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
//        switch ($type)
//        {
//            case "":
//
//        }
    }

    public function getUserType(): string
    {
        $sql = "SELECT user_type_name FROM `user_type` WHERE `id` = ?";
        if ($stmt = $this->db_instance->prepare($sql)) {
            $stmt->bind_param('i', $param_id);
            $param_id = $_SESSION['user_type_id'];
            if ($stmt->execute()) {
                $stmt->store_result();
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $user_type_name);
                    if (mysqli_stmt_fetch($stmt)) {
                        return $user_type_name;
                    }
                }
            }
        }
        return '';
    }
}