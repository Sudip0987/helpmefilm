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
  <link rel = "stylesheet" href = "css/maincss.css">

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
$searchFilters="";
$sql = "Select * from Topic t,Users u where u.userID=t.posterID  and postType= 'contest' order by pdate desc;";
$wordCollection="";
if(isset($_GET['searchTopic'])){
  $searchTopic= $_GET['searchTopic'];
  $wordsArray=explode(" ", $searchTopic);
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
  $searchSql="Select *, topic,count(topic) as matches from users u,topic tc,TopicTags tt,Tags t where tc.posterID=u.userID and tc.topicID=tt.topicID and tt.tagID=t.tagID and postType='contest' and (". $searchFilters." ) group by topic order by matches desc;";
  $sql=$searchSql;
}



//$topicDesc = "";
//$sql = "SELECT t.topicID,topic,topicDesc,pdate,email,name, count(replyID)as totalReplies from Topic t, Users u, Replies r WHERE t.posterID=u.userID and t.topicID = r.topicID;";
  echo "    <div class = 'container-expand-md'><p style='color:white'>
  <div class='row justify-content-center style='margin-bottom:10px;'>
                        <div class='col-12 col-md-12 col-lg-12'>
                            <form class='card card-sm' action='viewContest.php'  method='GET'>
                                <div class='card-body row no-gutters align-items-center'>
                                    <div class='col-auto'>
                                        <i class='fas fa-search h4 text-body'></i>
                                    </div>
                                    <!--end of col-->
                                    <div class='col-md-9'>
                                        <div class = 'col'>
                                        <input class='form-control form-control-lg form-control-borderless' id ='searchTopic' name='searchTopic' type='search' placeholder='Search topics or keywords'>
                                        </div>
                                    </div>
                                    <!--end of col-->
                                    <div class='col-md-3'>
                       <div class='col-md-12' style='margin-left: 20px;' >
                                        <button   ' class='btn btn-lg btn-block btn-warning 'type='submit'>Search</button>
                                     </div>                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
    </div>
<div class = 'row'>
  <div class='col-9 col-md-9 col-lg-9'>
";
$tagDb=$db;
 $result = mysqli_query($db,$sql) or die ($sql);
    if(mysqli_num_rows($result)>0){
      while($row=$result->fetch_assoc()){

        $topicID=$row["topicID"];
        $topicDesc=$row['topicDesc'];
        //$topicDesc = TextUtility::summarize($row['topicDesc'],200);
      
        $email =$row["email"];
      $topic = $row["topic"];
      $pdate = $row["pdate"];
      $name =$row["name"];
      $tagList = "none";
      //$totalReplies = $row["totalReplies"];
      $totalReplies = "10";
    //  $topicDesc = $row["topicDesc"];

    //reading all the tags for this specific topic
      $tags="";

        $tagsSql = "Select t.tagID,t.tagName from tags t, TopicTags tt,topic tc where t.tagID=tt.tagID and tt.topicID=tc.topicID and tt.topicID=".$topicID;
    $tagResult= mysqli_query($tagDb,$tagsSql) or die($tagsSql);
     if(mysqli_num_rows($tagResult)>0){
      while($tagRow=$tagResult->fetch_assoc()){
        $tagID= $tagRow['tagID'];
        $tagName = $tagRow['tagName'];
        $tags =$tags."<a href=''><small style='color:rgba(255,255,255,0.8);border:1px solid rgba(255,255,255,0.1);padding:5px;border-radius:5px;'>".$tagName."</small></a> &nbsp&nbsp";
      }
    }


      echo "  

 <div class = 'row justify-content-center ' style='margin-top:25px; '>
      <div class = 'col-12 col-md-12 col-lg-12'>
        <div class = 'card' >
          <div class = 'card-body' >
            <div class = 'row' style = 'margin-bottom:10px;'>
              <div class = 'col-12 col-md-12 col-lg-12 '>
              <h5><a href='contestDetails.php?topicID=$topicID'>$topic</a></h5>

              </div>
            </div>
            <div class = 'row'  style = 'margin-bottom:10px;'>
              <div class ='col-9 col-md-9 col-lg-9 ' style='max-height: 5.4em;
  line-height: 1.5em;overflow-y:hidden;' >
                <p> $topicDesc</p>
                </div>
    <div class ='col-3 col-md-3 col-lg-3 text-center '> 
                                 <div class = 'row' >
                                    <div class ='col-12 col-md-12 col-lg-12 text-right'>
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
                                             
                                        </div>
                                    </div> <!--row ends here-->
                                    </div>

                </div>
                <div class = 'row text-left'>
                  <div class ='col-sm-4'>
                    <small>$totalReplies Comments</small>
                  </div>
                  <div class ='col-sm-4'>
                   Tags:&nbsp&nbsp $tags

                    
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
          No Posts Found!  Try again with different keywords
          </div></div></div></div>";
  }
  $userPosts="";
  $tempID=0;
  if(isset($_SESSION['userID'])){
      $tempID=$_SESSION['userID'];

  }
    $sql = "Select * from Topic t,Users u where u.userID=t.posterID  and postType= 'contest' and userID=".$tempID." order by pdate;";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){
          $tempTopicID= $row['topicID'];
          $tempTopic = $row['topic'];
          $userPosts =$userPosts. "<div class='row' style='margin-top:20px;'>
                        <div class='col' style='max-height: 2.4em;
  line-height: 1.2em;overflow-y:hidden;'>
                        <a  href = 'contestDetails.php?topicID=$tempTopicID'>$tempTopic</a>
                        </div>
                        </div>";

        }
      }else {
          $userPosts="No Posts Found!";

      }
?>
</div>
  <div class='col-3 col-md-3 col-lg-3' style='margin-top:25px;'>

    <div class='row'>
        <div class = 'col-12 col-md-12 col-lg-12' >
            <div class = 'card'>
                <div class = 'card-body'>
                 
                    <div class = 'row'>
                        
                            <div class = 'card' style = 'border:none'>
                                <div class = 'card-body'>
                                    <h5 class='card-title'>Your Posts</h5>
                                    <div class = 'row'>
                                        <div class = 'col'>
                                       <?php echo $userPosts; ?>
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
