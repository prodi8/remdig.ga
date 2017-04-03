<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php

session_start();

if(!isset($_SESSION["session_username"])):
header("location:login.php");
else:


include ("dbconnect.php");

require_once dirname(__FILE__) . '/log4php/Logger.php';
Logger::configure(dirname(__FILE__) . '/log4php.properties', 'LoggerConfiguratorIni');
$logger = Logger::getRootLogger();

// получаем переменные из формы
$username = $_SESSION['session_username'];
$msg = $_REQUEST['msg'];
$action = $_REQUEST['action'];

if ($action=="add"){
    // добавление данных в БД
    $sql = "INSERT INTO gb(username, dt, msg) VALUES ('$username', NOW(), '$msg')";
    try{
        $logger->debug("Insert data with query: " . $sql);
        $r = mysql_query($sql);
    } catch (Exception $ex) {
        $logger->error("Failed to insert data with query: " . $sql);
        $logger->error("Exception: " . $ex);
    }
    
}

if ($action=="delete"){
    // удаление базы гостевой
    $sql = "DELETE FROM gb";
    try{
        $logger->debug("Delete data with query: " . $sql);
        $r = mysql_query($sql);
    } catch (Exception $ex) {
        $logger->error("Failed to delete data with query: " . $sql);
        $logger->error("Exception: " . $ex);
    }
    
}

header("Location: index.php");

?>