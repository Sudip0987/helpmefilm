<!doctype html>
<html lang="en">
  <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script src="https://use.fontawesome.com/4c8273f771.js"></script>
      <title>
        Help Me Film
      </title>
      <link rel="stylesheet" type="text/css" href="css/resourcesCss.css">
  </head>

  <?php
      if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
    include ("includes/header.php");
    include("includes/handleData.php");
    $userID= $_SESSION['userID'];

  ?>


<body onload="loadAllData('<?php echo $_GET['depKey']; ?>','<?php echo $userID; ?>')">
<button onclick="checks()" class='form-control'>sssss</button>    
</body>
<script type="text/javascript" href = "includes/contestFirebase.php">
  
</script>

</html>
