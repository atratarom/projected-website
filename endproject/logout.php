<?php
	session_start();
	session_destroy();
	header("Location: loginFirst.html");
	exit();
?>