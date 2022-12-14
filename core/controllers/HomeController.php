<?php
class HomeController extends Controller
{

    function process($param)
    {
        // TODO: Implement process() method.
        $action = array_shift($param);
        switch ($action) {
            case '':
                header("HTTP/1.0 200");
                $this->header['title'] = 'Home';
                $this->header['description'] = 'Jobseeker\s homepage';
                $this->view = 'home';
                break;
            case 'sitemap':
                header("HTTP/1.0 200");
                $this->header['title'] = 'Sitemap';
                $this->header['description'] = 'Sitemap';
                $this->view = 'sitemap';
                break;
            default:
                $this->redirect('Error');
        }
    }
}