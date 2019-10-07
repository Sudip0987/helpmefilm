<?php
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
if(isset($_SESSION['email'])){

}else {
	header('location:loginPage.php');
}
?>