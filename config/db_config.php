<?php

class Database
{
    public $dbName;
    public $dbHost;
    private $dbPassword= '';
    public $dbUser;

    public function __construct($dbName, $dbUser, $dbHost)
    {
        $this->dbName = $dbName;
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
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

}