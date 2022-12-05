<?php
class RouterController extends Controller
{
    protected Controller $controller;

    function __construct()
    {
        session_start();
        if(!isset($_SESSION['id']))
        {
            $_SESSION['role'] = 'Guest';
            $_SESSION['id'] = null;
            $_SESSION['logged'] = false;
            $_SESSION['message'] = '';
        }
    }

    public function process($param)
    {
        // TODO: Implement process() method.
        $parsed_url = $this->parseUrl($param[0]);
        if(empty($parsed_url[1]))
            $this->redirect('home');
        array_shift($parsed_url);
        $controller_name = $this->dashesToCamel(array_shift($parsed_url) . 'Controller');
        if(file_exists('../core/controllers/'.$controller_name.'.php'))
        {
            $this->controller = new $controller_name;
            $this->controller->process($parsed_url);
            $this->data['title'] = $this->controller->header['title'];
            $this->data['description'] = $this->controller->header['description'];
            $this->view = 'index';
        } else {
            $this->redirect('error');
        }
    }

    public function parseUrl($url): array
    {
        $parse_url = parse_url($url);
        $parse_url['path'] = ltrim($parse_url['path'], '/');
        $parse_url['path'] = trim($parse_url['path']);
        return explode('/', $parse_url['path']);
    }

    public function dashesToCamel(string $str): array|string
    {
        $str = str_replace('-', ' ', $str);
        $str = ucwords($str);
        return str_replace(' ', '', $str);
    }
}