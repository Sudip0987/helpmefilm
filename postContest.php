<?php
 include('./php/checkUser.php');
 include('./php/registerphp.php');
$_SESSION['topicID']='-1'; ?>
<!doctype html>
<html lang="en">
   <head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>


     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     
         <link rel = "stylesheet"  type="text/css" href = "css/maincss.css">


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
   $deadline='';
   $location='';
   $tags = '';
    $topic = '';
    $topicID="-1";
        $topicDesc = '';
        $btName='Publish';
      include ("./includes/header.php");
      if(isset($_GET['topicID'])){
        $topicID= $_GET['topicID'];
        //$_SESSION['topicID']= $topicID;
              $btName='Confirm Edit';
   //selecting a topic
   $sql = "select * from topic where topicID=".$topicID." limit 1";
   $result = mysqli_query($db,$sql) or die ("error");
    if(mysqli_num_rows($result)>0){
      while($row=$result->fetch_assoc()){
        $topic= $row["topic"];
        $topicDesc =$row["topicDesc"];$deadline=$row['contestDeadline'];
        $deadline=$row['contestDeadline'];
      }
    }
    $sql = "Select * from Tags t, TopicTags tt where t.tagID=tt.tagID and tt.topicID=".$topicID.";";
       $result = mysqli_query($db,$sql) or die (mysqli_error($db));
        if(mysqli_num_rows($result)>0){
      while($row=$result->fetch_assoc()){
         $tags= $tags .",".$row["tagName"];
         
         
      }
    }
      }else {
        $topicID="-1";
      }
      ?>
   <body>
      <div class = "container-expand-md text-center">
         <div class = "row">
            <div class= "col-sm-1">
            </div>
            <div class = "col-sm-7" style = "margin-top:20px;padding: 10px;">
               <div class = "card"  >
                  <div class = "card-body" style =  >
                     <form method = "post" id= "topicForm" action = "topicPage.php" style="padding: 20px;">
                        <div class = "row" style = "margin-bottom: 10px;">
                           <div class ="col text-left">
                              <h4>Create a contest</h4>
                           </div>
                        </div>
                        <div class = "row" style= "padding-top: 20px;">
                           <div class = "col">
                              <div class = "row" >
                                 <div class = "col text-left">
                                    <h5 >Title :*</h5> 
                                 </div>
                              </div>
                              <div class = "row">
                                 <div class = "col col text-left">
                                    <input type = "text" id= "topic" value ='<?php echo $topic ?>' class = "form-control" name = "topic"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class = "row" style= "padding-top: 20px;">
                           <div class = "col">
                              <div class = "row">
                                 <div class = "col text-left">
                                    <h5 >Description<small> (Optional):  </small></h5>
                                 </div>
                              </div>
                              <div class = "row" >
                                 <div class = "col">
                                    <textarea class = "form-control col-xs-12"  style="min-width: 100%;" name="editor" id="editor" rows="100" > <?php echo $topicDesc; ?></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class = "row" style= "padding-top: 20px;">
                           <div class = "col">
                              <div class = "row">
                                 <div class = "col text-left">
                                    <h5 >Tags: </h5>
                                 </div>
                              </div>
                              <div class = "row">
                                 <div class = "col col text-left">
                                    <input type = "text" value = '<?php echo $tags; ?>' class = "form-control" name = "tags" id = "tags"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class = "row"  hidden style= "padding-top: 20px;">
                           <div class = "col">
                              <div class = "row">
                                 <div class = "col text-left">
                                    <h5 >Submission Type: </h5>
                                 </div>
                              </div>
                              <div class = "row">
                                 <div class = "col col text-left">
                                    <input type = "text" value = 'n' class = "form-control" name = "subType" id = "subType"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class = "row" style= "padding-top: 20px;">
                           <div class = "col">
                              <div class = "row">
                                 <div class = "col text-left">
                                    <h5 >Submission Deadline: </h5>
                                 </div>
                              </div>
                              <div class = "row">
                                 <div class = "col col text-left">
                                    <input type = "text" value = '<?php echo $deadline; ?>' class = "form-control" name = "subDeadline" id = "subDeadline"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                       
                        <div class = "row" style= "padding-top: 20px;">
                           <div class = "col">
                            <input type='hidden' name = 'topicID'value='<?php 
                            echo $topicID;
                            ?>'
                            />
                              <input type='hidden' name = 'type' value='contest'/>
                               <input type='hidden' name = 'location' value=''/>

                                      <?php
                            
                                if($topicID>0){
                      echo "<button type='submit' name='btEditTopic' id = 'btPostTopic' style= 'min-width:100%;' class='btn btn-warning text-dark '>Confirm Edit</button>";
                                }else {
                                  echo "<button type='submit' name='btPostTopic' id='btPostTopic'  style= 'min-width:100%;' class='btn btn-warning text-dark '>Confirm Publish</button>";
                                }
                              
                            ?>
                           </div>
                        </div>
                     </form>
                     <script>
                        CKEDITOR.replace('editor');
                        
                        
                     </script>
                  </div>
               </div>
            </div>
            <div class = "col-sm-4 text-left" style = "margin-top:20px;padding: 10px; line-height: 1.68;">
               <h4 class="text-large text-bold"><i class="wc-l-help wc-green"></i>&nbsp;Contest GUIDELINES</h4>
               <p>Include a title to your Contest and a more detailed description. The more unique and informative your contest, the better the chance you have of people engaging with you.</p>
               <h5 class="text-caps spc-n">Contest</h5>
               <ul>
                  <li>Include a title to your contest and a more detailed description. The more unique and man.</li>
                  <li>Include a title to your contest and a more detailed description. The more unique and man.</li>
                  <li>Include a title to your contest and a more detailed description. The more unique and man.</li>
               </ul>
               
               <hr>
               <p>Remember to follow the <a class="honesty-policy-link wyzantModal" href="#">Helpmefilm</a> policy when composing your question.</p>
            </div>
         </div>
      </div>
   </body>
</html>
<script>
$(document).ready(function(){
 
 $('#tags').tokenfield({
  autocomplete:{
   source: ['PHP','Codeigniter','HTML','JQuery','Javascript','CSS','Laravel','CakePHP','Symfony','Yii 2','Phalcon','Zend','Slim','FuelPHP','PHPixie','Mysql'],
   delay:100
  },
  showAutocompleteOnFocus: true
 });
 
$('#topicForm').on('btPostTopic', function(event){
  event.preventDefault();
  if($.trim($('#topic').val()).length == 0)
  {
   alert("Please Enter Job Title");
   return false;
  }
 
  else if($.trim($('#tags').val()).length == 0)
  {
   alert("Please Enter Atleast one Tag");
   return false;
  }
  else
  {
   var form_data = $(this).serialize();
   $('#btPostTopic').attr("disabled","disabled");
   $.ajax({
    url:"forum.php",
    method:"POST",
    data:form_data,
    beforeSend:function(){
     $('#btPostTopic').val('Submitting...');
    },
    success:function(data){
     if(data != '')
     {
      $('#topic').val('');
      $('#editor').val('');
      $('#tags').tokenfield('setTokens',[]);
      $('#success_message').html(data);
      $('#btPostTopic').attr("disabled", false);
      $('#btPostTopic').val('Submit');
     }
    }
   });
   setInterval(function(){
    $('#success_message').html('');
   }, 5000);
  }
 });
 
});
</script>