<?php include('./php/registerphp.php');

if(isset($_GET['topicID'])){
$_SESSION['topicID'] = $_GET['topicID'];

}else {
	include('./php/checkUser.php');
}
?>

<!doctype html>
<html lang="en">
	<head> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/tags.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/tags.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<link rel = "stylesheet" type="text/css" href = "css/maincss.css">

	</head>

	<?php
	    if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
$userID="";
    if(isset($_SESSION['userID'])){
    	$userID= $_SESSION['userID'];
    	$email= $_SESSION['email'];
    }
    	$topicID = $_SESSION['topicID'];


		include ("./includes/header.php");
		    include("includes/contestFirebase.php");

	?>
		

<body onload="loadApplicants('<?php echo $topicID; ?>','<?php echo $userID; ?>')">
	<!--onchange="uploadFile(event,'<?php echo $topicID; ?>','<?php echo $userID; ?>',document.getElementById('subDetail').value)" -->
<input type='file' hidden  onchange="storeFile(event)" id = 'btUpload' name='btApply'>


	<?php
	$visibilityOption="";
	$topic = "";
	$topicDesc ="";
	$pdate = "";
	$posterID="";
	$subOption="Upload a file";
	$applyButton="<div class ='card' style='border:none;'>
	
	<div class='row' style='background-color:#2c2e31;border:none;'>
					<div class = 'col-12'>
					<p class='form-control' style='border:none'>Description</a>
					</div>
				</div>
				<div class='row'>
					<div class = 'col-12'>
					<textarea  style='margin:10px;margin-top:0px;' id='subDetail' name ='subDetail 'class='form-control' rows='4' cols='12'></textarea>
					</div>
				</div>
				<div class='row'>
					<div class = 'col-6'>
					<p class='form-control' style='border:none' id = 'labelFileName'>Upload your file</p>
					</div>
					<div class = 'col-6'>
					
                                      <label  class='btn btn-warning text-dark btn-banner btn-block' for='btUpload'  ><span>Choose a file </span> </label >
                                      <div id='divSpinner'>

                                      </div>
					</div>
				</div>
				<div class='row'>
					<div class = 'col-12'>
						
					</div>
				</div>
	</div>
	</div>
	<div class='card-body' >";
	?>

	<button type='submit' hidden onclick="uploadFile('<?php echo $topicID; ?>','<?php echo $userID; ?>',document.getElementById('subDetail').value,'<?php echo $email; ?>');" name='btApply' id="btApply" class='btn btn-warning text-dark btn-banner btn-block'>Make a Submission</button>" 
	<?php $location  = "";
	$tags="";
	$name =""; 
	$email = "";
	$advertiserBio="";
	$totalReplies = "";
	//$sql = "select topic,topicDesc, count(replyID) as totalReplies from topic t,Replies r where t.topicID=r.topicID and topicID="."9"."limit 1";
	 $sql = "select bio,topic,topicDesc,location, userID, count(replyID) as totalReplies,email,name,pdate from topic t,Replies r, Users u where postType='contest' and u.userID = t.posterID and t.topicID=r.topicID and t.topicID=".$topicID." limit 1";
	 $result = mysqli_query($db,$sql) or die ($sql);
    if(mysqli_num_rows($result)>0){
    	while($row=$result->fetch_assoc()){
    		$topic= $row["topic"];
    		$topicDesc =$row["topicDesc"];
    		$pdate = $row["pdate"];
    		$name = $row["name"];
    		$posterEmail =$row["email"];
    		$posterID= $row["userID"];
    		$location = $row["location"];
    		$advertiserBio=$row["bio"];

    		$totalReplies = $row["totalReplies"];

    	}
    }
    if($posterID==""){
    	      header('location:jobs.php');

    }
    $applicantProfile = "";
      // $sql = "Select * from Applicants where topicID=".$topicID. " and userID=(select userID from users where email ='".$_SESSION['email']."' limit 1)";
		    	$sql= "Select u.userID, u.name from Applicants a, Topic t, Users u where a.userID=u.userID and t.topicID = a.topicID and t.topicID=".$topicID;
		       $result = mysqli_query($db,$sql) or die ($sql);
		       

		     if(mysqli_num_rows($result)>0){
		     		while($row=$result->fetch_assoc()){
		     			if(isset($_SESSION['userID'])){
		     	if($_SESSION['userID']==$row['userID']){
		     		     $applyButton="<button class='btn btn-warning text-dark btn-banner btn-block'>Already Applied</button>";

		     	}
		     }
		     	$tempID=$row['userID'];
		     	$tempName = $row['name'];

		    	}
		    }
    //applicant function ends here

    if(isset($_SESSION['email'])){
	$userEmail = $_SESSION['email'];

    }else{
    	$userEmail = "";

    }
$showOptions = "";
	$applyOption = "<div class='row'>
	<div class = 'col-12' >
							<form method = 'POST' href = 'jobPage.php'>
							<input type = 'hidden' value = '$topicID' name = 'jobID'/>
							$applyButton
							<label  class='btn btn-warning text-dark btn-banner btn-block' id='applyLabel' for='btApply'  ><span id='submitSpan'>Submit </span> </label >
							<button type='submit' name='btRefer' class='btn btn-warning text-dark btn-banner btn-block'>Send to a friend</button>
							</form>
							</div>
								<div class = 'card' style = 'margin-top:10px;'>
								<div class = 'card-body'>
									<h5 class='card-title'>Advertiser's Info</h5>
									<div class = 'row'>
										<div class = 'col'>
											<a href = 'viewProfile.php?userID=$posterID'>$name</a>
										</div>

									</div>
									
									<div class = 'row'>
										<div class = 'col'>
											<small>$advertiserBio
											</small>
										</div>

									</div>



								</div>
							</div>
							</div>";
    if($userEmail==$posterEmail){
    $applyOption="	<div class = 'card' style='border:none'>
								<div class = 'card-body'>
									<h5 class='card-title'>Submissions</h5>
								
									
									<div class = 'row'>

										<div class = 'col-12 col-md-12 col-lg-12'>
											<div class='row' style='margin-top:5px;'>
			          							<div class='col' id ='divApplicants'>
			          							
			          							</div>
			          							</div>
										</div>

									</div>



								</div>
							</div>";
    		$showOptions="

 <div class ='col-1 col-md-1 col-lg-1 text-right'   >
               		<div class='dropdown '>
				      <button class='form-control' style='width:30px;'  type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
				      &#8942;
				      </button>
				      <div class='dropdown-menu dropdown-menu-right' style = 'background-color:rgba(200,200,200);' aria-labelledby='dropdownMenuButton'>
 <a class = 'dropdown-item btn-info' style='color:black;' href = 'postContest.php?topicID=$topicID'>Edit</a>

                  <form method='POST' action = 'jobPage.php'>
                  <input type='hidden' value='$topicID' name='topicID'/>
                     <button type='submit' id = 'btDelete' name='btDelete' class = 'dropdown-item btn-info'>Remove</button>						
                  </form>				      </div>
				   </div>
				</div>


    	";
    } else {
    		
    }

	
echo "<div class = 'container-expand-md'>
	<div class = 'row sticky-top' style= 'margin-top:25px;margin-bottom:25px;'>


		<div class = 'col-8 col-md-8 col-lg-8' >
			<div class = 'card'>
				<div class = 'card-body'>
					<div class = 'row'>

						<div class ='col-12 col-md-12 col-lg-12 text-left'  >
							<div class = 'row'>
								<div class = 'col-11 col-md-11 col-lg-11' >
									<h5>$topic</h5>
											<a href = 'viewProfile.php?userID=$posterID'>$name</a><br>
									<small> &nbsp$pdate</small><br>


										


									<br><br>


									<!--Topic here-->
								</div>
								<div class = 'col-1 col-md-1 col-lg-1'>
								$showOptions
								</div>
							</div>
							<div class = 'row'>
								<div class = 'col' >
									$topicDesc
								</div>
							</div>
						</div>






					</div>

				</div>
			</div>
		</div> <!--first column ends here -->
		<div class = 'col-4 col-md-4 col-lg-4' style='max-height:700px;
    overflow-y:scroll;'>
			<div class = 'card'>
				<div class = 'card-body'>
					<div class = 'row'>
						
						<div class = 'col-12'>
						<div id='applyDiv'>
						$applyOption
						</div>
						</div>
						

						</div>

					</div>
				</div>
			</div> <!--Card-->
		</div>  <!--Second Column ends here-->
	</div> <!--row ends here-->

";
	


	?>

		
	<div>
</body>
<script type="text/javascript" href = "includes/contestFi.php">
	
</script>
</html>
