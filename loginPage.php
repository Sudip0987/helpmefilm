<?php include('./php/registerphp.php');
if(isset($_SESSION['email'])){
  header('location:profile.php');
}
 ?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href = "css/maincss.css">
      <title>
        Help Me Film
      </title>
  </head>

  <?php
    include ("./includes/header.php");
  ?>
  
<!------ Include the above in your HEAD tag ---------->
<body>

<div class = "container" style='border' >
      <div class="row text-center mb-4" >
    <div class="col-md-12">

    </div>
  </div>
  <div class="row text-center">
      <div class="col-md-6 offset-md-3">
          <div class="card" >
              <div class="card-body">
                                   <div class="login-title">
                      <h4>Log In</h4>
                  </div>
                  <div class="login-form mt-4">

                      <form method = "GET" action = "loginPage.php">
                      
                        <div class="form-row">
                            <div class="form-group col-md-12">
                              <input id="email" name="email" placeholder="Email Address" class="form-control" type="email">
                            </div>
                            <div class="form-group col-md-12">
                              <input type="password" class="form-control" name = "password" id="pass" placeholder="Password">
                            </div>
                          </div>
                         <div class="form-row">
                      
                    </div>                        
                        
                        <div class="form-row">
                            <button type="submit" name="login" class="btn btn-warning text-dark btn-banner btn-block">Login</button>
                        </div>
                    </form>
                  </div>
                  <div class="form-row">
                  </div> 
                   <div class="login-forgot text-center mt-2">
                      
                          <?php
                           if(isset($_GET['failed'])){
                            echo "Wrong email/password combination";
                            }
                             ?>
                        
                    </div>
                  <div class="login-forgot text-center mt-2">
                      <span style='color:rgba(255,255,255,0.7)'>Don't have an account? </span><br><a href="./registerPage.php">Register here</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
     </div>
</body>
