<?php
require('config/db_config.php');
require('config/utils.php');

$connection = new Database('todo', 'root', '127.0.0.1');
try {
    $dsn = "mysql:host={$connection->dbHost};dbname={$connection->dbName};charset=UTF8";
    $pdo = new PDO($dsn, $connection->dbUser, $connection->getDBPassword());

    /**
     * Error Handling Strategies
     *
     * PDO::ERROR_SILENT – PDO sets an error code for inspecting using the PDO::errorCode() and PDO::errorInfo() methods. The PDO::ERROR_SILENT is the default mode.
     * PDO::ERRMODE_WARNING – Besides setting the error code, PDO will issue an E_WARNING message.
     * PDO::ERRMODE_EXCEPTION – Besides setting the error code, PDO will raise a PDOException.
     */
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($pdo){
        $msg = "connected to the $connection->dbName database successfully";

        $log = new Utils($msg, false);
        echo $log->createLog();
    }
} catch (PDOException $e) {
    $log = new Utils($e->getMessage(), true);
    echo $log->createLog();
    die($e->getMessage());
}
