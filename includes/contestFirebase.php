<script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-storage.js"></script>


<script>

    var firebaseConfig = {
    apiKey: "AIzaSyAbt2TaZihi0VKAx0s7zxgFKLGgOwGAfAI",
    authDomain: "helpmefilm-a2808.firebaseapp.com",
    databaseURL: "https://helpmefilm-a2808.firebaseio.com",
    projectId: "helpmefilm-a2808",
    storageBucket: "helpmefilm-a2808.appspot.com",
    messagingSenderId: "113446590680",
    appId: "1:113446590680:web:8f1217caa877f9b2f35fad",
    measurementId: "G-WS7T7M4PE3"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  var uploadedFile="";
  var database = firebase.database();
  var userID="";
  var visibilityOption="hidden";

function listFiles(contestID){
 

}



function loadAllData(departmentkey, userID){
  this.userID=userID;
  console.log("man: "+departmentkey +" "+userID);
  listFiles(departmentkey);
loadUserFiles(departmentkey,userID);

}


 function uploadFile(contestID,userID,description,email){
  console.log("SSS"+ email);
  if(email==""){
    window.location="loginPage.php";
  }else {
    var email=email;
     if(this.uploadedFile!=""){
      console.log("uploading"+email);
      userFile=this.uploadedFile;
      console.log(userID+"\n"+contestID);
          var files = userFile.target.files;
          var file = files[0];
          var storageUrl="contest/contest"+contestID+"/"+file.name;
          console.log(storageUrl);
          var storageRef = firebase.storage().ref(storageUrl);
           document.getElementById("divSpinner").innerHTML=" <div class='spinner-border text-primary role='status'></div>";
          storageRef.put(file).then(function(snapshot){
            storageRef.getDownloadURL().then(function(url){

              document.getElementById("divSpinner").innerHTML=" Uploaded <span class = 'fa fa-check'></span>";
             database.ref("contest/contest"+contestID+"/user"+userID+"/").set({
                resName:file.name,
                 resPosterID:userID,
                resUrl:url,
                description:description,
                email:email

              
              }); 
            
            });
          });

              setTimeout(function(){
                document.getElementById("divSpinner").innerHTML = '';
            }, 3000);

            }else {
              alert("Please choose a file to upload");
            }

      }
      

    }



    function deleteFiles(filePath,fileKey,fileName){
      console.log("filePath: " +filePath+"\n dataPath: "+filePath+fileName);
             database.ref(filePath+fileKey).remove();
             loadUserFiles(this.currentDepKey,this.userID);

        
    }

function storeFile(tempFile){
  this.uploadedFile=tempFile;
    var files = uploadedFile.target.files;
      var file = files[0];
        console.log(file.name);
        document.getElementById("labelFileName").innerHTML=file.name;


}

    function checks(){
      console.log("Sss");
       /* database.ref("contest/").set({
            resName:"",
             

          
          }); */
   }




    function loadApplicants(contestID,currentUserID){

      console.log(contestID);
      var path="contest/contest"+contestID;
       database.ref(path).once('value',function(snapshot){
                  console.log("Sss");

        var htmlContent="";
        snapshot.forEach(function(childSnapshot){
                            console.log("Sssss2");

          var childData = childSnapshot.val();
          var childKey=childSnapshot.key;

          if(childData['resPosterID']==currentUserID){
            document.getElementById("submitSpan").innerHTML="Resubmit";

          }
          console.log(childData);
                    
          
                          htmlContent+=" \n\
                                                                                  <div class = 'col-12 col-md-12 col-lg-11 text-left'>\n\
                                                                                     \n\<details><summary><a href='viewProfile.php?userID="+childData['resPosterID']+"'style='border:none;background-color:transparent;color:rgba(255,255,255,0.7);' >"+childData['email']+"</a></summary>\n\
                                             <label><a href='"+childData['resUrl']+"'>"+childData['resName']+"</a></label>\n\
                                                </details>\n\
                                                                                    \n\
                                                                                  </div>\n\
                                                                                  <hr style='margin:1px;background-color:rgba(255,255,255,0.1);'>";
                       
        });
        document.getElementById("divApplicants").innerHTML=htmlContent
      });
    }

</script>