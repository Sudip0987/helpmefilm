<?php include('./php/registerphp.php') ;
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

<div class = "container">
      <div class="row text-center mb-4">
    <div class="col-md-12">
    </div>
  </div>
  <div class="row text-center">
      <div class="col-md-6 offset-md-3">
          <div class="card">
              <div class="card-body"  >
                                   <div class="register-title" >
                      <h5>Register</h5>
                  </div>
                  <div class="register-form mt-4">
                      <form method = "GET" action = "registerPage.php">
                        <div class="form-row text-dark">

                            <div class="form-group col-md-12">
                              <input id="fullname" name="fullname" required placeholder="Full Name" class="form-control" type="text">
                            </div>
                            <div class="form-group col-md-12">
                              <input type="email" class="form-control" required name = "email" id="email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                              <input type="password" class="form-control" required requiredname = "password" id="password" placeholder="Password">
                            </div>
                             <div class="form-group col-md-12">
                              <input type="password" class="form-control" name = "confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                            </div>
                            <div class="form-group col-md-12">
                              <input type="text" class="form-control"  name = "address" id="address" placeholder="Location (Optional)">
                            </div>
                             <div class="form-group col-md-12">
                              <input type="text" class="form-control" name = "website" id="website" placeholder="Your Website (Optional)">
                            </div>
                            <div class="form-group col-md-12">
                              <input type="text" class="form-control" name = "contact" id="contact" placeholder="Contact no (Optional)">
                            </div>
                            <div class="form-group col-md-12">
                            
                              <input type="text" class="form-control"  required  name = "profession" id="profession" placeholder="Profession">
                            </div>
                            
                             <div class="form-group col-md-12">
                              <textarea class="form-control" rows='4' name = "bio" id="bio" minlength = '100' required placeholder="Tell us about yourself (required)"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                            </div>
                          </div>
                         <div class="form-row">
                      
                    </div>                        
                        <div class="form-row">
                            <button type="submit" name = "register" class="btn btn-warning text-dark btn-banner btn-block">Register</button>
                        </div>
                    </form>
                  </div>
                  <div class="logi-forgot text-center mt-2">
                    <div class = "errorDiv" style = " width: 92%; 
                                                      margin: 0px auto; 
                                                      padding: 10px; 
                                                      color: #a94442; 
                                                      text-align: left;">
                                            <?php include('./php/errors.php')?>
                                          </div>

                     <span style='color:rgba(255,255,255,0.7)'> Already have an account? </span><br><a href="./loginPage.php">Login here</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
     
  </div>
</body>
