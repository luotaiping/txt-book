<?php

ini_set("session.save_path", "/tmp");
session_start();


$ip = "127.0.0.1";
$port = 9585;

if (!isset($_SESSION['user']))
	header("Localtion: login.php");

if (empty($_GET['operator']) || empty($_GET['book']))
	exit();

$operator = $_GET['operator'];

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("创建失败！\n");
socket_connect($socket, $ip, $port);
socket_write($socket, $operator."|".$_SESSION['user']."|".$_GET['book']);

$ret = "";
$ret = socket_read($socket, 4096);

echo $ret;


?>