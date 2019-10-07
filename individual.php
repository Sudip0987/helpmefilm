<!doctype html>
<html lang="en">
  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  
    <link href="css/maincss.css" type="text/css" rel="stylesheet" id="sss">

      <title>
        Help Me Film
      </title>
  </head>

  <?php
    include ("./includes/header.php");
  ?>

<body>
  

<div class="container"><h2>Example 3 </h2></div>
<div id="exTab3" class="container"> 
<ul  class="nav nav-pills">
      <li class="active">
        <a  href="#1b" data-toggle="tab">Company</a>
      </li>
      <li><a href="#2b" data-toggle="tab">Individual</a>
      </li>
          </ul>

      <div class="tab-content clearfix">
        <div class="tab-pane active" id="1b">
          <h3>Same as example 1 but we have now styled the tab's corner</h3>
        </div>
        <div class="tab-pane" id="2b">
          <h3>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h3>
        </div>
        <div class="tab-pane" id="3b">
          <h3>We applied clearfix to the tab-content to rid of the gap between the tab and the content</h3>
        </div>
          <div class="tab-pane" id="4b">
          <h3>We use css to change the background color of the content to be equal to the tab</h3>
        </div>
      </div>
  </div>


<!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
 
</body>
      

</html>
