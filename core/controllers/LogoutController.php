<?php
class LogoutController extends Controller
{

    function process($param)
    {
        // TODO: Implement process() method.
        $action = array_shift($param);
        switch ($action) {
            case '':
                session_unset();
                $_SESSION['email'] = 'Guest';
                $_SESSION['id'] = null;
                $_SESSION['user_type'] = 'guest';
                $_SESSION['logged'] = false;
                $_SESSION['message'] = 'Logged out successfully.';
                $this->redirect('home');
            default:
                $this->redirect('error');
        }
    }
}