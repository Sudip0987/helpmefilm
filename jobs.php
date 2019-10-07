<?php 

    include_once('php/connection.php') 

    
?>

<!doctype html>
<html lang="en">
<head>  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/tags.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <title>
        Help Me Film
    </title>
    <link rel = "stylesheet" type="text/css" href = "css/maincss.css">

</head>

<?php
include ("./includes/header.php");
?>


<body >
<?php 
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
$topicID="";
$email = "";
$topic = "";
$pdate = "";
$name ="";
$totalReplies="";
//$topicDesc = "";
//$sql = "SELECT t.topicID,topic,topicDesc,pdate,email,name, count(replyID)as totalReplies from Topic t, Users u, Replies r WHERE t.posterID=u.userID and t.topicID = r.topicID;";
$sql = "Select * from Topic t,Users u where u.userID=t.posterID  and postType= 'job' order by pdate desc;";
$wordCollection="";
$searchFilters="";
if(isset($_GET['searchTopic'])){
  $searchTopic= $_GET['searchTopic'];
  $wordsArray=explode(" ", $searchTopic);
  $location=$_GET['searchLocation'];
  if(strtolower($location)=="any"){
    $location="";
  }
  $arrayLength= count($wordsArray);
  $i=0;
  foreach($wordsArray as $keyword){
    $i=$i+1;
    $wordCollection= $wordCollection. "<br>".$keyword;
    if($i!=$arrayLength){
    $searchFilters= $searchFilters. "t.tagName LIKE '%".$keyword."%' or tc.topic LIKE '%".$keyword."%' or tc.location LIKE '%".$keyword."%' or ";
    }else{
    $searchFilters= $searchFilters. "t.tagName LIKE '%".$keyword."%' or tc.topic LIKE '%".$keyword."%' or tc.location LIKE '%".$keyword."%' ";

}
  }
  $searchSql="Select *, topic,count(topic) as matches from users u,topic tc,TopicTags tt,Tags t where tc.posterID=u.userID and tc.topicID=tt.topicID and tt.tagID=t.tagID and postType='job' and (". $searchFilters." ) and tc.location LIKE '%".$location."%' group by topic order by matches desc;";
  $sql=$searchSql;
}


    echo "      <div class = 'container-expand-md'>
   <br/>
  <div class='row justify-content-center style='margin-bottom:10px;'>
      <div class='col-12 col-md-12 col-lg-12'>
         <form class='card card-sm' action='jobs.php' method='GET'>
            <div class='card-body row no-gutters align-items-center'>
               <div class='col-auto'>
                  <i class='fas fa-search h4 text-body'></i>
               </div>
               <!--end of col-->
               <div class='col-md-6' >
                 <div class = 'col'>
                  <input class='form-control form-control-lg form-control-borderless' id = 'searchTopic' name = 'searchTopic' type='search' placeholder='Type keywords here' >
                 </div>

               </div>
               <div class = 'col-md-3''>
                                  <input class='form-control form-control-lg form-control-borderless' value='Any' name = 'searchLocation' id = 'searchLocation' type='search'  placeholder='Location' >

               </div>
               <!--end of col-->
               <div class='col-3' >

               <div class='col-md-12' style='margin-left: 20px;' >
                  <button   ' class='btn btn-lg btn-block btn-warning 'type='submit'>Search</button>
               </div>
             </div>
               <!--end of col-->
            </div>
         </form>
      </div>

      <!--end of col-->
   </div>
<div class = 'row'>
  <div class='col-9 col-md-9 col-lg-9'>
  ";
$db2=$db;
 $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){
            $topicID=$row["topicID"];
            $topicDesc=$row['topicDesc'];
            $email =$row["email"];
            $topic = $row["topic"];
            $pdate = $row["pdate"];
            $name =$row["name"];
            $tagList = "none";
            $location = $row["location"];
            //$totalReplies = $row["totalReplies"];
            $totalReplies = "10";
        //  $topicDesc = $row["topicDesc"];

        //reading all the tags for this specific topic
            
 

            echo "  
             <div class = 'row justify-content-center ' style='margin-top:25px; '>
            <div class = 'col-12 col-md-12 col-lg-12'>
                <div class = 'card' >
                
                    <div class = 'card-body' >
                        <div class = 'row' style = 'margin-bottom:10px;'>
                            <div class = 'col'>
                            <h5><a href = 'jobPage.php?topicID=$topicID'>$topic</a></h5>
                            </div>
                        </div>
                        <div class = 'row'  style = 'margin-bottom:10px;'>
                            <div class ='col-9 col-md-9 col-lg-9 ' style='max-height: 5.4em;
                            line-height: 1.5em;overflow-y:hidden;' >
                                <p> $topicDesc</p>
                                </div>
                                <div class ='col-3 col-md-3 col-lg-3 text-right'> 
                                 <div class = 'row' >
                                    <div class ='col-12 col-md-12 col-lg-12'>
                                        <div class = 'row'>
                                            <div class = 'col '>
                                                <h7>$name<h7>
                                                </div>
                                            </div>
                                            <div class = 'row'>
                                                <div class = 'col '>
                                                    <small>$pdate</small>
                                                </div>
                                            </div>
                                             <div class = 'row'>
                                                <div class = 'col '>
                                                    <small>$location</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-row ends here-->
                                    </div>
                              

                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>

        ";
        }
    }else {
    echo "<div class = 'row justify-content-center ' style='margin-top:25px; '>
      <div class = 'col-12 col-md-12 col-lg-12'>
        <div class = 'card' >
        
          <div class = 'card-body' >
          No Jobs Found!  Try again with different keywords
          </div></div></div></div>";
  }
$userJobs="";
$tempID=0;
  if(isset($_SESSION['userID'])){
      $tempID=$_SESSION['userID'];

  }
    $sql = "Select * from Topic t,Users u where u.userID=t.posterID  and postType= 'job' and userID=".$tempID." order by pdate;";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){
          $tempTopicID= $row['topicID'];
          $tempTopic = $row['topic'];
          $userJobs =$userJobs. " <div  style='max-height: 2.4em;
                                          line-height: 1.2em;overflow-y:hidden;'><a href = 'jobPage.php?topicID=$tempTopicID'>$tempTopic</a></div><hr style='margin:10px;background-color:rgba(255,255,255,0.09)'>";

        }
      }else {
          $userJobs="No related jobs found!";

      }

?>
</div>
  <div class='col-3 col-md-3 col-lg-3' style='margin-top:25px;'>

    <div class='row'>
        <div class = 'col-12 col-md-12 col-lg-12' >
            <div class = 'card' style='border:none;'>
                <div class = 'card-body' style='border:none;'>
                 
                    <div class = 'row'>
                        
                            <div class = 'card'  style = 'border: none;'>
                                <div class = 'card-body'>
                                    <h5 class='card-title'>Jobs Related To You</h5>
                                    <div class = 'row' style='margin-top:30px;'>
                                        <div class = 'col'>
                                        
                                          <?php echo $userJobs; ?>
                                        
                                        </div>

                                    </div>
                                  



                                </div>
                            </div>

                        </div>

                    </div>
                </div><!--Card-->
            </div> 
        </div> <!--row ends here-->
        

    </div>


    
  </div>
</div>

</div>


    </body>

    </html>
