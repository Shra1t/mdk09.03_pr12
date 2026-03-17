<?php
	include("../settings/connect_datebase.php");

	$IdUser = getAuthUserId();
    $Message = $_POST["Message"];
    $IdPost = $_POST["IdPost"];

    $mysqli->query("INSERT INTO `comments`(`IdUser`, `IdPost`, `Messages`) VALUES ({$IdUser}, {$IdPost}, '{$Message}');");
?>