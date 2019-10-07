 <?php 
  include('./php/registerphp.php');
 ?>
 
<!doctype html>
<html lang="en">
    <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!------ Include the above in your HEAD tag ---------->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/4c8273f771.js"></script>

        <link rel = "stylesheet" href = "css/viewProfile.css">

        <script src="ckeditor/ckeditor.js"></script>  
      <script>
         $(function() {
            $("#testInput").tags({
                unique: true,
                maxTags: 5
            });
        });
    </script>
            <title>
                Help Me Film
            </title>
    </head>

    <?php
        include ("./includes/header.php");
        $userID = $_GET['userID'];
        $sql = "Select * from Users where userID=".$userID;
         $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result)>0){
      while($row=$result->fetch_assoc()){
        $profession = $row['profession'];
        $userName = $row['name'];
        $userEmail = $row['email'];
        $contact = $row['contact'];
        $location = $row['address'];
        $bio= $row['bio'];
      }
    }

    ?>

    <body  onload = "loadAllData('<?php echo $userID; ?>');" >
<div class="container emp-profile">

     <input type="hidden" id = "userID" value = "<?php echo $userID;?>"
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img" style='height: 150px;' >
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" id="profileImage" class="img-circle" alt=""/>
                           
                            <div class="file btn btn-lg btn-primary" >
                            <div id = "imageSpinner">
                                
                              </div>

                                <?php 

                                  echo $userEmail;
                                  ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                   <h5>
                                        <label><?php echo $userName; ?></label>
                                    </h5>
                                    <div id = "professionDiv">

                                    <h6>
                                        <label  class = "profession" id="labelProfession"><?php echo $profession; ?></label>
                                    </h6>
                                    </div>
                                        <br>
                                <ul class="nav nav-tabs">
                                    <li class='nav-item'>
                                      <a class='nav-link active' data-toggle='tab' href='#about'>About</a>
                                    </li>
                                    <li class='nav-item'>
                                      <a class='nav-link ' data-toggle='tab' onClick= 'hideOptions()' href='#resume'>Resume</a> <!--sss -->
                                    </li>
                                </ul>

                        </div>
                    </div>
                    <div class="col-md-2" hidden>
                        <input type="button" class="form-control" id="btEditProfession" onClick="showEditOptions('professionDiv',document.getElementById('labelProfession').innerHTML)" style='border-color:rgba(255,255,255,0.2);background-color: transparent;color:rgba(255,255,255,0.9);' value="Edit Profile"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                      <form>
                        <div class="profile-work">
                           
                            <p>SKILLS</p>
                            
                         <div id = "skillDiv">

                         </div>
                            <div  class= "row" style="margin-top:20px;">
                            <div class = "col-md-9" hidden>
                            <input required type = "text" placeholder="Add Skills Here" class = "form-control" id = "textSkills">                            
                            </div>
                            <div class ="col-md-3 text-center">
                              
                             <input type="button" class = "form-control " hidden value="&#65291;
" id = "btAddSkills" onClick="addSkills(document.getElementById('textSkills').value,document.getElementById('userID').value)">

                            </div>

                           </div>

                            
                        </div>
                      </form>
                    </div>
                    <div class="col-md-8">
                     <!-- Tab panes -->
                      <div class="tab-content">
                        <div class='tab-pane container fade in show active' id='about'>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-5">
                                                <p id='name'><?php echo $userName; ?></p>
                                            </div>
                                            <div class="col-md-2">
                                    
                                              <input type="button" hidden id = "editDetails">
                                                <label for="editDetails" hidden  ><span class="fa fa-pencil"></span> </label >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-md-5">
                                                <p><?php echo $profession; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-5">
                                                <p><?php echo $userEmail; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-5">
                                                <p><?php echo $contact; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Location</label>
                                            </div>
                                            <div class="col-md-5">
                                                <p><?php echo $location; ?></p>
                                            </div>
                                        </div>
                                        <div class = "row" style='margin-top:20px'>
                                          <div class = "col-md-10">
                                            <h6>Bio
                                    
                                             
                                            </h6>
                                          </div>
                                          <div class = "col-md-2">
                                             <input  type="button" hidden id = "editBio"  onClick="editBio(document.getElementById('bioLabel').innerHTML)">
                                                <label for="editBio" hidden  ><span class="fa fa-pencil"></span> </label >
                                          </div>
                                        </div>
                                        <div class = "row" >

                                          <div class = "col-md-10" id ="bioDiv">
                                            
                                           <label id="bioLabel"><?php echo $bio; ?> </label>
                                          </div>
                                        </div>

                                        
                        </div>
                            <div class='tab-pane container fade' id='resume'>

                                <div class = "row" style = "margin-bottom:20px;">
                                    <div class = "col-md-5" id = "resumeUrlDiv">

                                     </div>
                                   
                                  <div class = "col-md-3 text-right" id = "divSpinner" >
                                    
                                  </div>
                                   <div class = "col-md-2">
                                    
                                    <input type="file" hidden onchange ="uploadResume(event)"  hidden id = "btAddFile">
                                      <label for="btAddFile" hidden  ><span class="fa fa-pencil"></span> </label >
                                  </div>
                                </div>
                                <hr style='background-color:rgba(255,255,255,0.1);'>
                                <div id = "resumeData">

                                 

                                    <!--load Data here-->
                                </div>
                               
                             <button type="button" class="btn btn-info btn-lg" data-toggle="modal" style='color: rgba(255,255,255,0.9);
    background-color: transparent;border-color:rgba(255,255,255,0.2);' data-target="#myModal" hidden>Add New Role</button>
                            <?php include ('profileBuilder.php') ?>
                                <!--row ends here-->    
                            </div>  
                          <!--tanb pame resume end-->  

                    </div>
                 </div>
                </div>
            </form>           
        </div>
    </body>
     <script> 

      </script>
                  <script src = "js/profileFunction.js">
</script>
    
</html>
