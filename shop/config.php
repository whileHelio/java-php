<?php
	session_start();

	$db = new mysqli("localhost", "root", "", "shop");

	$db->set_charset("utf8");
?>