<?php


$db = require_once 'db.php';

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($link, "utf8");

$projects = [];
$tasks = [];
$content = '';
define ('SECONDS_IN_DAY', 86400);
