<?php
	// название  сервера БД
	define ("HOST", "localhost");
	// название базы данных
	define ("DATABASE", "u1607_remdigga");
	// пользователь MySQL
	define ("MYSQL_USER", "u1607_pronin");
	// пароль к MYSQL
	define ("MYSQL_PASS", "HoliPass22");
	
	
	// создаем базу данных и таблицу  gb
	$link1=mysql_connect(HOST, MYSQL_USER, MYSQL_PASS) or die("Нет соединения с MySQL сервером!");
	mysql_query ("CREATE DATABASE IF NOT EXISTS ".DATABASE) or die ("Не могу создать базу данных gb.");
	mysql_select_db(DATABASE) or die("Нет содениения с требуемой базой данных!");
	mysql_query ("CREATE TABLE IF NOT EXISTS gb (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR (100), dt DATETIME, msg TEXT)") or die ("Не могу создать таблицу gb.");
?>