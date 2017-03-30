<?php

include ("dbconnect.php");

// получаем переменные из формы
$username = $_REQUEST['username'];
$msg = $_REQUEST['msg'];
$action = $_REQUEST['action'];

if ($action=="add"){
    // добавление данных в БД
    $sql = "INSERT INTO gb(username, dt, msg) VALUES ('$username', NOW(), '$msg')";
    try{
        Logger::getLogger("root")->log("Insert data with query: " . $sql);
        $r = mysql_query($sql);
    } catch (Exception $ex) {
        Logger::getLogger("root")->log("Insert data failed with query: " . $sql);
        Logger::getLogger("root")->log("Exception: " . $ex);
    }
    
}

if ($action=="delete"){
    // удаление базы гостевой
    $sql = "DELETE FROM gb";
    try{
        Logger::getLogger("root")->log("Delete data with query: " . $sql);
        $r = mysql_query($sql);
    } catch (Exception $ex) {
        Logger::getLogger("root")->log("Delete data failed with query: " . $sql);
        Logger::getLogger("root")->log("Exception: " . $ex);
    }
    
}

header("Location: index.php");

?>