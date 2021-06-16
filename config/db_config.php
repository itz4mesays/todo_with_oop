<?php

require __DIR__.'/utils.php';

class Database
{
    private $dbName = 'todo';
    private $dbHost = '127.0.0.1';
    private $dbPassword= '';
    private $dbUser = 'root';
    public $conn;

    public function __construct()
    {
        $this->conn = null;
        $this->setConnection();
    }

    public function getDbName()
    {
        return $this->dbName;
    }

    public function getDbHost()
    {
        return $this->dbHost;
    }

    public function getDBPassword()
    {
        return $this->dbPassword;
    }

    public function getDbUser()
    {
        return $this->dbUser;
    }

    public function setConnection(){
        $log = new Utils();

        try {
            $dsn = "mysql:host={$this->dbHost};dbname={$this->dbName};charset=UTF8";
            $this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword);

            /**
             * Error Handling Strategies
             *
             * PDO::ERROR_SILENT – PDO sets an error code for inspecting using the PDO::errorCode() and PDO::errorInfo() methods. The PDO::ERROR_SILENT is the default mode.
             * PDO::ERRMODE_WARNING – Besides setting the error code, PDO will issue an E_WARNING message.
             * PDO::ERRMODE_EXCEPTION – Besides setting the error code, PDO will raise a PDOException.
             */
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $msg = "connected to the $this->dbName database successfully";
       
            $log->setLog($msg);
            $log->setFlag(false); 
            $log->createLog();

        } catch (PDOException $e) {
            $log->setLog($e->getMessage());
            $log->setFlag(true); 
            $log->createLog();
            die($e->getMessage());
        }

        return $this->conn;
    }

}