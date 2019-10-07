<?php 
		header('location:../index.php');
		session_start();
		//unset($_SESSION["email"]);
		session_destroy();
		header("Location: ../loginPage.php");
?>
