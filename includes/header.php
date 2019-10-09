
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="#" class="navbar-brand">
        <img src="images/logo.svg" height="28" alt="HelpMeFilm">
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
           <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="resources.php">Resources</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="viewPost.php">Forum</a>
      </li> 
       <li class="nav-item">
        <a class="nav-link" href="jobs.php">Jobs</a>
      </li> 
      
       <li class="nav-item">
        <a class="nav-link" href="viewContest.php">Contests</a>
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
              <button class = 'btn btn-warning' id ='btJob'>Login</button>
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