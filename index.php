<?php 

  include_once('php/connection.php') 
  
?>

<!doctype html>
<html lang="en">
<head>  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  
     
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script type="text/javascript" src="js/tags.js"></script>
  <script src="ckeditor/ckeditor.js"></script>
  <title>
    Help Me Film
  </title>
  <link rel = "stylesheet" href = "css/maincss.css">

</head>

<?php
include ("./includes/header.php");
include("./includes/handleData.php")
?>


<body onload="loadHomeData()" >


<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel" >
  <!--Indicators-->
  <ol class="carousel-indicators" >
    <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-2" data-slide-to="1"></li>
    <li data-target="#carousel-example-2" data-slide-to="2"></li>
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox" >
      <div class="carousel-item active">
      <!--Mask color-->
      <div class="view" >
        <img class="d-block w-100" height="450" src="resources/wallpaper.jpg" style='opacity: 0.9;'
          alt="Second slide">
        <div class="mask rgba-black-strong"></div>
      </div>
      <div class="carousel-caption" style="margin-top: 20px">
        <img src="resources/sc2.png" height="200" width ="400" style='opacity: 1; margin-top: 20px;margin'>        <img src="resources/sc3.png" height="200" width ="400" style='opacity: 1; margin-top: 20px;'>

        <h3 class="h3-responsive" style>Discussion Forum</h3>
        <p>A place where you can discuss your ideas with people like you.</p>
      </div>
    </div>
    <div class="carousel-item">
      <!--Mask color-->
      <div class="view">
        <img class="d-block w-100" height="450" src="resources/wallpaper.jpg"
          alt="Second slide">
        <div class="mask rgba-black-strong"></div>
      </div>
      <div class="carousel-caption">
                <img src="resources/sc4.png" height="300" width ="550" style='opacity: 0.9;'>

        <h3 class="h3-responsive" style>Resources</h3>
        <p>We have a template every film document you will ever need </p>
      </div>
    </div>
  <div class="carousel-item">
      <!--Mask color-->
      <div class="view">
        <img class="d-block w-100" height="450" src="resources/wallpaper.jpg"
          alt="Second slide">
        <div class="mask rgba-black-strong"></div>
      </div>
      <div class="carousel-caption">
                <img src="resources/sc1.png" height="300" width ="500" style='opacity: 0.9;'>

        <h3 class="h3-responsive" style>Protfilio</h3>
        <p>Build your resume online</p>
      </div>
    </div>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>






<?php 
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
$topicID="";
$topic = "";
$pdate = "";
$totalReplies="";
$searchFilters="";
$sql = "Select *, count(r.topicID) as totalComments from Topic t,Replies r where t.topicID=r.topicID group by t.topicID order by totalComments limit 2;
";
$wordCollection="";




//$topicDesc = "";
//$sql = "SELECT t.topicID,topic,topicDesc,pdate,email,name, count(replyID)as totalReplies from Topic t, Users u, Replies r WHERE t.posterID=u.userID and t.topicID = r.topicID;";
  echo "    <div class = 'container-expand-md'><p style='color:white'>
  
      <h3 style='padding-left:20px;color:rgba(255,255,255,0.8);'>Top Threads</h3>

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
      
      $topic = $row["topic"];
      $pdate = $row["pdate"];
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
        $tags =$tags."<a href=''><small style='border:1px solid rgba(255,255,255,0.1);padding:5px;border-radius:5px;'>".$tagName."</small></a> &nbsp&nbsp";
      }
    }


      echo "  

 <div class = 'row justify-content-center ' style='margin-top:25px; '>
      <div class = 'col-12 col-md-12 col-lg-12'>
        <div class = 'card' >
          <div class = 'card-body' >
            <div class = 'row' style = 'margin-bottom:10px;'>
              <div class = 'col-12 col-md-12 col-lg-12 '>
              <h5><a href='topicPage.php?topicID=$topicID'>$topic</a></h5>

              </div>
            </div>
            <div class = 'row'  style = 'margin-bottom:10px;'>
              <div class ='col-9 col-md-9 col-lg-9 ' style='max-height: 5.4em;
  line-height: 1.5em;overflow-y:hidden;' >
                <p> $topicDesc</p>
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
  $contests="";
 
    $sql = "Select * from Topic t,Users u where u.userID=t.posterID  and postType= 'contest' order by pdate limit 3;";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result)>0){
        while($row=$result->fetch_assoc()){
          $tempTopicID= $row['topicID'];
          $tempTopic = $row['topic'];
          $contests =$contests. "<div class='row' style='margin-top:20px;'>
                        <div class='col' style='max-height: 2.4em;
  line-height: 1.2em;overflow-y:hidden;'>
                        <a  href = 'topicPage.php?topicID=$tempTopicID'>$tempTopic</a>
                        </div>
                        </div>";

        }
      }else {
          $contests="None found";

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
                                    <h5 class='card-title'> Contests</h5>
                                    <div class = 'row'>
                                        <div class = 'col'>
                                       <?php echo $contests; ?>
                                        </div>

                                    </div>
                                  



                                </div>
                            </div>

                        </div>


                    </div>
                </div><!--Card-->
            </div> 
        </div> <!--row ends here-->

        <div class='row' style='margin-top:20px;'>
        <div class = 'col-12 col-md-12 col-lg-12' >
            <div class = 'card'>
                <div class = 'card-body'>
                 
                    <div class = 'row'>
                        
                            <div class = 'card' style = 'border:none'>
                                <div class = 'card-body'>
                                  <div class='col'>
                                    Resources
                                  </div>
                                    <div class='col-12' id="resHere"  style='max-height:200px;
                                             overflow-y:scroll;'>
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
</div>

</div>


    </body>

    </html>
