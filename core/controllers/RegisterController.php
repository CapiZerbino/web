<?php
class RegisterController extends Controller
{

    function process($param)
    {
        // TODO: Implement process() method.
        if($_SESSION["logged"]) {
            $this->redirect("home");
        }
        header("HTTP/1.0 200");
        $this->header["title"] = "Resister Page";
        $this->header["description"] = "Register an account";
        $action = array_shift($param);
        switch ($action) {
            case "":
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $model = new RegisterModel();
                    $model->loadParams($_POST["email"], $_POST["password"], $_POST["confirm_password"], $_POST["role"]);
                    $model->executeQuery("post");
                    $res = $model->getResponse();
                    if($res["message"] = "OK") {
                        $this->redirect('login');
                    } else {
                        $_SESSION['message'] = $res['message'];
                        $_SESSION['showMessage'] = true;
                        $_SESSION['messageType'] = 'danger';
                        $this->view = 'register';
                    }
                } else {
                    $this->view = 'register';
                }
                break;
            default:
                $this->redirect('error');
        }
    }
}