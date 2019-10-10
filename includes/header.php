<?php
$caption="Login";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['userID'])){
  if ($_SESSION['userID']!=""){
    $caption="Profile";
  }else {
    $caption= "Login";
  }
}
?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark" style='background: -webkit-linear-gradient(top, #23272A, rgba(0,0,0,0.89));'>
    <a href="index.php" class="navbar-brand">
       <img src="resources/logo.png" height="28"  width="60" alt="HelpMeFilm"><span style='color:rgba(255,255,255,0.75);'>HelpMeFilm</span>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">

          <style>
          
          #nav-link:focus{
            }
        </style>

           <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" id ="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id= "nav-link" href="resources.php">Resources</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="nav-link" href="viewPost.php">Forum</a>
      </li> 
       <li class="nav-item">
        <a class="nav-link" id="nav-link" href="jobs.php">Jobs</a>
      </li> 
      
       <li class="nav-item">
        <a class="nav-link" id="nav-link" href="viewContest.php"> Contests</a>
      </li>
     <!-- Dropdown -->
 
   
    </ul>
        </div>
        <div class="navbar-nav ml-auto">
          <ul class = "navbar-nav ml-auto">
            <li style = "margin-right: 10px;" > 
              <div id='menuList'>
              </div>
            </li>
           
          <li>
            <form method='post' action = 'loginPage.php' id='loginForm'>
              <button class = 'btn btn-warning' id ='btJob'><?php echo $caption ?></button>
            </form>
            </li>
         </ul>
        </div>
        <div class="navbar-nav">
        </div>
        
    </div>
    <script>

    var path = window.location.pathname;
    var page = path.split("/").pop();
    if(page=="viewPost.php" || page=="topicPage.php"){
         document.getElementById("menuList").innerHTML=" <form method='post' action = 'forum.php' id='askForm'>\n\
              <button class = 'btn btn-warning' id = 'btForum'>Create a post</button>\n\
            </form>";     


    }else if(page=="jobPage.php" || page=="jobs.php"){

        document.getElementById("menuList").innerHTML=" <form method='post' action = 'postJob.php' id='jobForm' style = 'margin-right: 10px;' >\n\
              <button class = 'btn btn-warning' id ='btJob'>Post a Job</button>\n\
            </form>";     

    }else if(page=="viewContest.php" || page=="contestDetails.php"){

        document.getElementById("menuList").innerHTML=" <form method='post' action = 'postContest.php' id='jobForm' style = 'margin-right: 10px;' >\n\
              <button class = 'btn btn-warning' id ='btJob'>Create a Contest</button>\n\
            </form>";     

    }
    </script>
</nav>