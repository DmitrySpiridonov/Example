<?php
@session_start();
$db_host = 'localhost';
$db_username = 'mysql';
$db_password = 'mysql';
$db_name = 'SS';

$is_connected = @mysql_connect($db_host, $db_username, $db_password);
$is_db_selected = $is_connected ? @mysql_select_db($db_name) : FALSE;

$errors = array();

if (!$is_connected) $errors[] = 'Не могу соединиться с базой данных';
if (!$is_db_selected) $errors[] = 'Не могу найти базу данных';
?>