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
    $userID= $_SESSION['userID'];

		include ("includes/header.php");
		include("includes/handleData.php");

	?>


<body onload="loadAllData('<?php echo $_GET['depKey']; ?>','<?php echo $userID; ?>')">

     <div class = "container-expand-md text-center">
         <div class = "row" id = "divFiles" style = "margin-top:20px;">
           
            <div class = "col-8 col-md-8 col-lg-8" >
                <div class= "card">
                  <div class="card-title"><h5>Resources</h5></div>
                  <div class = "card-body">

                    <div class = "col-12 col-md-12 col-lg-12" id="divFileList">
                  </div>
                  </div>
                </div>

            </div>

            <div class = "col-4 col-md-4 col-lg-4">
                  <div class='row'>
        <div class = 'col-12 col-md-12 col-lg-12' >

            <div class = 'card'>
                <div class = 'card-body'>
                  <input type="file" onchange ="uploadFile(event,'<?php echo $userID; ?>')"  hidden id = "btAddFile">
                                      <label  class='btn btn-warning text-dark btn-banner btn-block' for="btAddFile"  ><span>Contribute Documents </span> </label >
                                      <div id="divSpinner">

                                      </div>
                    <div class = 'row'>
                        
                           <div class = 'col-12 col-md-12 col-lg-12'>
                             <div class = 'card' style = 'border:none'>
                                <div class = 'card-body'>
                                    <h5 class='card-title text-left'>Your Uploads</h5>
                                    <div id= "divUserFiles">
                                     
                                  </div>
                                  



                                </div>
                            </div>
                           </div>

                        </div>

                    </div>
                </div><!--Card-->
            </div>
            </div>
        </div>
    </div>        
</body>
<script type="text/javascript" href = "includes/handleData.php">
	
</script>

</html>
