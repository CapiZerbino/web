<?php

abstract class Controller {
    protected array $data = array();
    protected string $view = '';
    protected array $header = array('title' => null, 'description' => null);

    abstract function process($param);
    public function renderView(): void
    {
        if($this->view != '') {
            extract($this->data);
            require ('../core/views/' . $this->view . '.php');
        }
    }
    public function redirect($url)
    {
        echo $url;
        header("Location: http://localhost/public/$url");
        header("Connection: close");
        exit;
    }
}