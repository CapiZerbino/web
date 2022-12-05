<?php
class ErrorController extends Controller
{
    public function process($param)
    {
        $action = array_shift($param);
        switch ($action) {
            case '':
                header("HTTP/1.0 404 Not Found");
                $this->header['title'] = 'Error 404';
                $this->header['description'] = 'Error 404';
                $this->view = 'error';
                break;
            default:
                $this->redirect('error');
        }
    }
}
