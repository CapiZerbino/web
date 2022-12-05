<?php

use JetBrains\PhpStorm\NoReturn;

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
    #[NoReturn] public function redirect($url): void
    {
        header("Location: $url");
        header("Connection: close");
        exit;
    }
}