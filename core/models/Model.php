<?php

const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'jobseeker';

abstract class Model {
    protected mysqli $db_instance;
    protected array $response = array('message' => '');
    function __construct()
    {
        $this->db_instance = $this->getDBInstance();
//        $this->genTables();
    }
    private function getDBInstance(): mysqli
    {
//        $sql = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ';';
//        $instance = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//        $instance->query($sql);
        return new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }
    private function genTables(): void
    {

    }
    function __destruct()
    {
        $this->db_instance->close();
    }
    abstract function executeQuery(string $type);
    public function getResponse(): array
    {
        return $this->response;
    }
}