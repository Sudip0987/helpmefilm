<?php
class Functions
{

    function login($db)
    {
    	$errors=array();
        $email = mysql_real_escape_string($_GET['email']);
        $password = mysql_real_escape_string($_GET['password']);
       
       
            $password = md5($password);
            //$sql = "SELECT * from Users where email='$email' and password='d41d8cd98f00b204e9800998ecf8427e'";
            $sql = "SELECT * FROM Users WHERE email = '$email' and password = '$password' limit 1";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) == 1)
            {
                        while($row=$result->fetch_assoc()){
                                $_SESSION['userID']=$row['userID'];
                            }

                $_SESSION['email'] = $email;
                $_SESSION['success'] = "You are now logged in";
                header('location: profile.php');

            }
            else
            {
                                header('location: loginPage.php?failed');

            }
        
    }



    function register($db)
    {

        $allGood=true;
        $fullname = mysql_real_escape_string($_GET['fullname']);
        $email = mysql_real_escape_string($_GET['email']);
        $password = mysql_real_escape_string($_GET['password']);
        $confirmPassword = mysql_real_escape_string($_GET['confirmPassword']);
        $address = mysql_real_escape_string($_GET['address']);
        $website = mysql_real_escape_string($_GET['website']);
        $contact = mysql_real_escape_string($_GET['contact']);
        $profession = mysql_real_escape_string($_GET['profession']);
        $bio = mysql_real_escape_string($_GET['bio']);

        if (empty($fullname))
        {
            array_push($errors, "Full name is required ");

        }
        if (empty($email))
        {
            array_push($errors, "Email is required ");

        }
        if (empty($password))
        {
            array_push($errors, "Password is required ");
        }
        if (empty($address))
        {
            $address += "";
        }
        if (empty($website))
        {
            $website += "";
        }
        if (empty($contact))
        {
            $contact += "";
        }
        if ($password != $confirmPassword)
        {
            array_push($errors, "Passwords did not match ");

        }

        $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user)
        { // if user exists
            if ($user['email'] === $email)
            {
                array_push($errors, "email already exists");
            }
        }

        if (count($errors) == 0)
        {
            $password = md5($password); //encrypt password before storing in database
            $sql = "Insert INTO Users (name,email,password,address,website,contact,profession,bio) VALUES
					('$fullname','$email','$password','$address','$website','$contact','$profession','$bio')";
            mysqli_query($db, $sql);
            $last_id = mysqli_insert_id($db);
            $_SESSION['userID'] = $last_id;
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";
            $errors = ""; //resseting errors variable
            header('location:../profile.php');
        }
    }

    function postTopic($db)
    {
        $errors=array();
        $topic = mysql_real_escape_string($_POST['topic']);
        $topicDesc = mysql_real_escape_string($_POST['editor']);
        $postType = mysql_real_escape_string($_POST['type']);
        $location = mysql_real_escape_string($_POST['location']);
   $tags = $_POST['tags'];
    $tagsArray = explode(', ', $tags);
    

        $topic = mysql_real_escape_string($_POST['topic']);
        $topicDesc = mysql_real_escape_string($_POST['editor']);
        $email = $_SESSION['email'];
        if (empty($topic))
        {
            array_push($errors, "Full name is required ");

        }
        if (empty($topicDesc))
        {
            array_push($errors, "Email is required ");

        }

        if (count($errors) == 0)
        {
            $sql = "Insert INTO Topic (topic,topicDesc,posterID,postType,location) VALUES
		('$topic','$topicDesc',(SELECT userID from Users where email='$email'),'$postType','$location')";

            if(isset($_POST['subType'])){
                $subType= $_POST['subType'];
                $contestDeadline= $_POST['subDeadline'];
                   $sql = "Insert INTO Topic (topic,topicDesc,posterID,postType,location,contestDeadline,subType) VALUES
        ('$topic','$topicDesc',(SELECT userID from Users where email='$email'),'$postType','$location','$contestDeadline','$subType')";
            }
            mysqli_query($db, $sql);
            $newTopicID = mysqli_insert_id($db) or die($sql);
            foreach($tagsArray as $tagValue){
                                  $newTagID = $this->checkTags($db,$tagValue);

                if($newTagID>-1){
                }else{
                    $sql = "Insert into Tags (tagName) VALUES('$tagValue');";
                mysqli_query($db, $sql);
                $newTagID = mysqli_insert_id($db);
                }

                $sql = "Insert into TopicTags (topicID,tagID) VALUES('$newTopicID','$newTagID');";
                mysqli_query($db, $sql);

                }

            $_SESSION['last_id'] = $last_id;
            $_SESSION['topicID'] = $last_id;
            $errors = ""; //resseting errors variable
            header('location:viewPost.php');
        }
        else
        {
            header('location:forum.php');

        }
    }

    
    function updateTopic($db)
    {
        $errors = array();
         $tags = $_POST['tags'];
    $tagsArray = explode(', ', $tags);
    
    	$topicID = $_POST['topicID'];
    	 $topic = mysql_real_escape_string($_POST['topic']);
        $topicDesc = mysql_real_escape_string($_POST['editor']);
        if (empty($topic))
        {
            array_push($errors, "Topic is required ");

        }

          if(isset($_POST['subType'])){
                        $subType= $_POST['subType'];
                $contestDeadline= $_POST['subDeadline'];
            $sql ="Update Topic set topic='".$topic."', subType='b".$subType."', contestDeadline='s".$contestDeadline."', topicDesc='".$topicDesc."' where topicID=".$topicID.";";
                        echo $sql;
                        echo $ss;
            }
       
        if (count($errors) == 0)
        {
            $sql = "Update Topic set topic='".$topic."', topicDesc='".$topicDesc."' where topicID=".$topicID.";";

            mysqli_query($db, $sql) or die ($sql);
            //deleting old tags and replacing them new one
              $sql = "Delete from  TopicTags where topicID=".$topicID.";";
                mysqli_query($db, $sql);
                foreach($tagsArray as $tagValue){
                 $newTagID = $this->checkTags($db,$tagValue);

                if($newTagID>-1){
                }else{
                    $sql = "Insert into Tags (tagName) VALUES('$tagValue');";
                mysqli_query($db, $sql);
                $newTagID = mysqli_insert_id($db);
                }

             
                $sql = "Insert into TopicTags (topicID,tagID) VALUES('$topicID','$newTagID');";
                mysqli_query($db, $sql);

                }


            header('location:viewPost.php');
        }
        else
        {
            header('location:forum.php');

        }
    }

    public function checkTags($db,$tagName){
        $sql = "SELECT * from Tags where tagName='".$tagName."';";
         $result = mysqli_query($db, $sql) or die ($sql);
        if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){
                return $row['tagID'];
            }
        }else {
            return -1;
        }


    }
    function deleteTopic($db)
    {
       
        $sql = "";
        $topicID = $_POST['topicID'];

        if (empty($topicID))
        {
            header('location:topicPage.php');

        }
        else
        {

      
            $sql = "delete from Applicants where topicID=" . $topicID . ";";
            

            $result = mysqli_query($db, $sql) or die($sql);

            $sql = "delete from TopicTags where topicID=" . $topicID . ";";
            

            $result = mysqli_query($db, $sql) or die($sql);
            $sql = " delete from Topic where topicID=" . $topicID . ";";
            $result = mysqli_query($db, $sql) or die($sql);
            if ($result)
            {

            }
            else
            {
                echo "<script> alert('Cannot delete this thread!')<script>";
            }
        }
    }

    function checkIfExists($sql){
    	$result = $result = mysqli_query($db, $sql);
    	if($result>0){

    		return true;
    	}else{
    		return false;
    	}
    }
        function postReply($db)
            {
                $topicID = $_SESSION['topicID'];
                $rComment = mysql_real_escape_string($_POST['editor']);
                $email = $_SESSION['email'];
                if (empty($rComment))
                {
                    header('location:topicPage.php');

                }
                else
                {

                    $sql = "Insert INTO Replies (topicID,rcomment,replierID) VALUES
                ('$topicID','$rComment',(SELECT userID from Users where email='$email'))";

                    mysqli_query($db, $sql) or die("error");
                    header('location:topicPage.php');
                }
            }

    function deleteReply($db,$replyID){
            
            $sql = "delete from Replies where replyID=" . $replyID . ";";
            

            $result = mysqli_query($db, $sql) or die ("error");
            if ($result)
            {
                header('location:topicPage.php');

            }
            else
            {
                echo "<script> alert('Cannot delete this comment!'')<script>";
            }
        

    }
    function updateReply($db){
    	$replyID= mysql_real_escape_string($_POST['replyID']);
    	 $replyText = mysql_real_escape_string($_POST['editor']);
        $email = $_SESSION['email'];
        if (empty($replyText))
        {
            array_push($errors, "Topic is required ");

        }
       
        if (count($errors) == 0)
        {
            $sql = "Update Replies set rComment='".$replyText."' where replyID=".$replyID.";";

            mysqli_query($db, $sql) or die ($sql);
           
            $errors = ""; //resseting errors variable
            header('location:topicPage.php');
        }
        else
        {
        	echo "<script>alert('Cannot edit your reply. Please try again!');</script>";
            header('location:forum.php');

        }
    }

        function applyForJob($db){
        
           if(isset($_SESSION['userID'])){
        $applicantEmail = $_SESSION['email'];
        $jobID = $_POST['jobID'];
        $subDetail=$_POST['subDetail'];
              $sql = "Insert INTO Applicants (topicID,userID,subDetail) VALUES
                ('$jobID',(SELECT userID from Users where email='$applicantEmail'),'$subDetail')";
            mysqli_query($db, $sql) or die($sql);
            }else{
    header('location:loginPage.php');
   }
    }


    function updateProfession($db){
       $userID= $_SESSION['userID'];
       $newProfession= $_POST['editedData'];
       $sql = "Update Users set profession='".$newProfession. "' Where userID=".$userID;
       mysqli_query($db,$sql) or die("Error 404!");
     
        //$userID = $_SESSION['userID'];
    }
     function updateBio($db){
       $userID= $_SESSION['userID'];
       $newBio= $_POST['editedBio'];
       $sql = "Update Users set bio='".$newBio. "' Where userID=".$userID;
       mysqli_query($db,$sql) or die("Error 404!");
     
        //$userID = $_SESSION['userID'];
    }
}
?>
