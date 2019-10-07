<?php include('./php/registerphp.php');

if(isset($_GET['topicID'])){
$_SESSION['topicID'] = $_GET['topicID'];

}else {
	include('./php/checkUser.php');
}
?>

<!doctype html>
<html lang="en">
	<head>  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/tags.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/tags.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	<link rel = "stylesheet" href = "css/maincss.css">

	</head>

	<?php
		include ("./includes/header.php");
	?>
		

<body>

	<?php
	$topic = "";
	$topicDesc ="";
	$topicID = $_SESSION['topicID'];
	$pdate = "";
	$tags="";
	$name =""; 
	$email = "";
	$totalReplies = "";
	//$sql = "select topic,topicDesc, count(replyID) as totalReplies from topic t,Replies r where t.topicID=r.topicID and topicID="."9"."limit 1";
	 $sql = "select userID,topic,topicDesc, count(replyID) as totalReplies,email,name,pdate from topic t,Replies r, Users u where postType='question' and u.userID = t.posterID and t.topicID=r.topicID and t.topicID=".$topicID." limit 1";
	 $result = mysqli_query($db,$sql) or die ($sql);
    if(mysqli_num_rows($result)>0){
    	while($row=$result->fetch_assoc()){
    		$topic= $row["topic"];
    		$topicDesc =$row["topicDesc"];
    		$pdate = $row["pdate"];
    		$name = $row["name"];
    		$posterEmail =$row["email"];
        $posterID=$row['userID'];

    		$totalReplies = $row["totalReplies"];
    	}
    }
    if($posterID==""){
            header('location:viewPost.php');

    }
       $sql = "Select * from Tags t, TopicTags tt where t.tagID=tt.tagID and tt.topicID=".$topicID.";";
       $result = mysqli_query($db,$sql) or die (mysqli_error($db));
       	$tags="";

        if(mysqli_num_rows($result)>0){
      while($row=$result->fetch_assoc()){
                 $tagName = $row['tagName'];

         $tags=$tags."<a href=''><small style='color:rgba(255,255,255,0.8);border:1px solid rgba(255,255,255,0.1);padding:5px;border-radius:5px;'>".$tagName."</small></a> &nbsp&nbsp";
        //$tags =$tags."<a href=''><small style='color:rgba(255,255,255,0.8);border:1px solid rgba(255,255,255,0.1);padding:5px;border-radius:5px;'>".$tagName."</small></a> &nbsp&nbsp";
      }
    }
    if(isset($_SESSION['email'])){
$userEmail = $_SESSION['email'];

    }else{
    	$userEmail = "";

    }
$showOptions = "";
    if($userEmail==$posterEmail){
    	$showOptions="

 <div class ='col-1 col-md-1 col-lg-1 text-center'   >
               		<div class='dropdown '>
				      <button class='form-control' style='width:30px;' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
				      &#8942;
				      </button>
				      <div class='dropdown-menu dropdown-menu-right' style = 'background-color:rgba(200,200,200);' aria-labelledby='dropdownMenuButton'>
 <a class = 'dropdown-item btn-info' style='color:black;' href = 'forum.php?topicID=$topicID'>Edit</a>

                  <form method='POST' action = 'topicPage.php'>
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
   <div class = 'col-12 col-md-12 col-lg-12' >
      <div class = 'card'>
         <div class = 'card-body'>
            <div class = 'row'>
               
               <div class ='col-9 col-md-9 col-lg-9 text-left'  >
                  <div class = 'row'>
                     <div class = 'col' >
                        <h5>$topic</h5>
                        <!--Topic here-->
                     </div>
                  </div>
                  <div class = 'row'>
                     <div class = 'col' >
                        $topicDesc
                     </div>
                  </div>
               </div>
             
               <div class ='col-2 col-md-2 col-lg-2 text-right' >
                  <div class = 'row'>
                     <div class = 'col' >
                        <h7>
                        $name
                        <h7>
                        <!--name here-->
                     </div>
                  </div>
                  <div class = 'row'>
                     <div class = 'col' >
                        <small>$posterEmail</small>
                     </div>
                  </div>
                  <div class = 'row'>
                     <div class = 'col' >
                        <small>$pdate</small> 										<!--date here-->
                     </div>
                  </div>
               </div>
            
  
  $showOptions
               
               
            </div>
            <div class = 'row text-left' style = 'padding-top: 20px;'>
               <div class ='col-6 col-md-6 col-lg-6  text-left' >
                  <small>$totalReplies Comments</small>
               </div>
               <div class ='col-6 col-md-6 col-lg-6 text-left' />
                  <small>
                     Tags: 
                    $tags
                  </small>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
";
	
	$replierName = "";
	$replierEmail = "";
	$rDate = "";
	$rComment = "";
	$replyOption="";
	$replyID="-1";
	$replyText="";
	 $sql = "select * from Topic t, Replies r, Users u where t.topicID = r.topicID and r.replierID=u.userID and t.topicID=".$topicID;
	 $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result)>0){
    	while($row=$result->fetch_assoc()){
    		$replierName= $row["name"];
    		$replierEmail =$row["email"];
    		$rDate = $row["rDate"];
    		$rComment = $row["rComment"];
    		$replyID=$row['replyID'];
    		$replyText = $row['rComment'];

    		if(isset($_SESSION['email'])){
    			$currentEmail=$_SESSION['email'];
    		}else {
    			$currentEmail="";
    		}
    		if($currentEmail==$replierEmail){
    			    			$replyOption = "	<div class = 'col-1 col-md-1 col-lg-1 text-right'' >
																		<div class='dropdown '>
																  <button class='form-control' style='width:30px;' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
																    &#8942;
																  </button>
																  <div class='dropdown-menu dropdown-menu-right' style = 'background-color:rgba(200,200,200);' aria-labelledby='dropdownMenuButton'>
																  <a class = 'dropdown-item btn-info' href = 'topicPage.php?topicID=$topicID&replyID=$replyID&replyText=$replyText' style='color:black;'>Edit</a>

                  <form method='POST' action = 'topicPage.php'>
                  <input type='hidden' value='$replyID' name = 'replyID'/>
                  <input type='hidden' value='$replyText' name = 'replyText'/>
                     <button type='submit' id = 'btReplyDelete' name='btReplyDelete' class = 'dropdown-item btn-info'>Remove</button>	
                  </form>
																  </div>
																</div>
																		</div>
											</div>";

    		}
    		echo "		
				<div class = 'card' style = 'margin-top:10px;'>
					<div class = 'card-body' >
						<div class = 'row' >

							<div class = 'col-9 col-md-9 col-lg-9 text-left'>
								$rComment

							</div>

							<div class = ' col-2 col-md-2 col-lg-2 text-right'>

								<div class = 'row'>
									<div class = 'col'>
										$replierName
									</div>
								</div>
								<div class = 'row'>
									<div class = 'col'>
										<small>$replierEmail</small>
									</div>
								</div>
								<div class = 'row'>
									<div class = 'col'>
										<small>$rDate</small>
										
									</div>
								</div>



							</div>
								$replyOption
							
									

					</div>

				</div>
			";
    		
    	}
    }

	?>

		<form method="POST" action = "topicPage.php">

			
				<div class = 'card' style = 'margin-top:10px;'>
					<div class = 'card-body'>
						<div class = 'row'>
							<div class = 'col-sm-12'>
								<textarea class = "form-control col-xs-12" style="min-width: 100%;" name="editor" id="editor" rows="100" >

									<?php
									if(isset($_GET['replyText'])){
											echo $_GET['replyText'];
								
									}
									?>
								</textarea>
							</div>
						</div>
							<div class = 'row'>
							<div class = 'col-sm-12' style = 'margin-top:20px;'>
								                  <input type='hidden' name = 'replyID' value='<?php
									
											if(isset($_GET['replyID'])){
											echo $_GET['replyID'];
								
									}
									

									?>' 
									/>
                            <?php

                            if(isset($_SESSION['email'])){

                            	if(isset($_GET['replyID'])){
                            		echo "<button type='submit' name='btEditReply' class='btn btn-warning text-dark btn-banner btn-block'>Confirm Edit</button>";
                            	}
                            	else {
                            		echo "<button type='submit' name='btPostReply' class='btn btn-warning text-dark btn-banner btn-block'>Add Reply</button>";

                            	}
                            		
                            	}else {
											echo "<a type='submit'  class='btn btn-warning text-dark btn-banner btn-block' href='loginPage.php'>Login to reply</a>";
                            }

                            ?>

					</div>
							

						</div>
					
				<script>
					CKEDITORBackGround = '#7D001D';
								CKEDITOR.replace('editor');


							</script>
			</div>
		</div>

		</form>
	<div>
</body>

</html>
