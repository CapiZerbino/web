<?php
class LoginController extends Controller {
    public function process($param)
    {
        // TODO: Implement process() method.
        if($_SESSION["logged"]) {
            $this->redirect('home');
        }
        header("HTTP/1.0 200");
        $this->header["title"] = "Login Page";
        $this->header["description"] = "Login with your account";
        $action = array_shift($param);
        switch ($action) {
            case "":
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    require ('../core/models/LoginModel.php');
                    $model = new LoginModel();
                    $model->loadParams($_POST["email"], $_POST["password"]);
                    $model->executeQuery("post");
                    $res = $model->getResponse();
                    if($res['message'] !== "OK") {
                        $_SESSION["message"] = $res["message"];
                        $_SESSION['showMessage'] = true;
                        $_SESSION['messageType'] = 'danger';
                        $this->view = "login";
                    } else {
                        $_SESSION["logged"] = true;
                        $_SESSION["id"] = $res["id"];
                        $_SESSION["email"] = $res["email"];
                        $_SESSION["user_type_id"] = $res["user_type_id"];
                        $_SESSION['showMessage'] = false;
                        $_SESSION['messageType'] = 'success';
                        $this->redirect("home");
                    }
                } else {
                    $this->view = "login";
                }
                break;
            default:
                $this->redirect("error");
        }
    }
}