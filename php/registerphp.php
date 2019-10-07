<?php
$db = mysqli_connect('localhost','root','','helpmefilm');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$email = "";
$errors = array();
include_once('connection.php');
include('functions.php');
$function= new Functions($db);

if(isset($_GET['register'])){
$function->register($db);
}

//login here
if(isset($_GET['login'])){
$function->login($db);

}
if(isset($_POST['btPostTopic'])){
 
    $function->postTopic($db);


}
if(isset($_POST['btEditTopic'])){

	
    $function->updateTopic($db);

  

}

if(isset($_POST['btUpdateProfession'])){

    $function->updateProfession($db);
  
}
if(isset($_POST['btUpdateBio'])){

    $function->updateBio($db);
  
}


if(isset($_POST['btPostReply'])){
    $function->postReply($db);

  
}
if(isset($_POST['btEditReply'])){
    $function->updateReply($db);

  
}

if(isset($_POST['btDelete'])){
$function->deleteTopic($db);


}
if(isset($_POST['btReplyDelete'])){
$replyID=$_POST['replyID'];
$function->deleteReply($db,$replyID);



}

if(isset($_POST['btApply'])){
 
    $function->applyForJob($db);


}




?>
