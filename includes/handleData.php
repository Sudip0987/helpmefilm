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
  var database = firebase.database();
  var currentDepKey="";
  var userID="";
  var visibilityOption="hidden";

function listFiles(departmentKey){
 

  this.currentDepKey=departmentKey;
 var path= "resources/"+departmentKey+"/";


      database.ref(path).on('value',function(snapshot){
        var htmlContent="";
        snapshot.forEach(function(childSnapshot){
          childKey=childSnapshot.key;
          if (childKey!="depName"){
            childData=childSnapshot.val();
          htmlContent+="     <div class='row text-left' style='padding:5px;padding-left:10px;'>\n\
            <div class= 'col'>\n\
                  <a href='"+childData['resUrl'] +"' >\n\
                 <div class = 'card' style='padding:5px;padding-left:10px;' >\n\
                    "+childData['resName']+"\n\
                </div>\n\
                  </a>\n\
            </div>\n\
          </div>";
            }
          
        });
          document.getElementById("divFileList").innerHTML=htmlContent;

      });
}

function loadDepartments(){
  var path= "resources/";
      database.ref(path).once('value',function(snapshot){

        snapshot.forEach(function(childSnapshot){
          var childData = childSnapshot.val();
          var childKey=childSnapshot.key;
  document.getElementById("divFolders").innerHTML+="<div class = 'col-sm-2' style = 'margin-top:20px;'>\n\
              <a href='viewFiles.php?depKey="+childKey+"'>\n\
               <div class = 'card'  >\n\
                  <input type='hidden' id='currentDepKey' value='"+childSnapshot.key
                  +"'>\n\
                  <div class = 'card-body'  >\n\
                   <p style='padding:20px;'> "+childData['depName']+"<p>\n\
                  </div>\n\
                </div>\n\
            </a>\n\
            </div>";

          });

      });

}

function loadAllData(departmentkey, userID){
  this.userID=userID;
  console.log("man: "+departmentkey +" "+userID);
  listFiles(departmentkey);
loadUserFiles(departmentkey,userID);

}

 function uploadFile(resumeFile, userID){
      var files = resumeFile.target.files;
      var file = files[0];
      var storageUrl="contest/"+this.currentDepKey+"/"+file.name;
      console.log(storageUrl);
      var storageRef = firebase.storage().ref(storageUrl);
       document.getElementById("divSpinner").innerHTML=" <div class='spinner-border text-primary role='status'></div>";
      storageRef.put(file).then(function(snapshot){
        storageRef.getDownloadURL().then(function(url){

          document.getElementById("divSpinner").innerHTML=" Uploaded <span class = 'fa fa-check'></span>";
          var newFileKey=database.ref("resources/"+currentDepKey).push().key;
         database.ref("resources/"+currentDepKey+"/"+newFileKey+"/").set({
            resName:file.name,
             resPosterID:userID,
            resUrl:url

          
          }); 
        
        });
      });

          setTimeout(function(){
            document.getElementById("divSpinner").innerHTML = '';
        }, 3000);

    }

    function loadUserFiles(departmentkey,userID){
      console.log(departmentkey);
      var path="resources/"+this.currentDepKey;
       database.ref(path).once('value',function(snapshot){
        var htmlContent="";
        snapshot.forEach(function(childSnapshot){
          var childData = childSnapshot.val();
          var childKey=childSnapshot.key;
          console.log("Sss");
                    if (childKey!="depName"){
                        if (childData['resPosterID']==userID){
                                var filePath=`resources/`+this.currentDepKey+`/`;

                          htmlContent+=" <div class = 'row'>\n\
                                                                                  <div class = 'col-10 col-md-10 col-lg-11 text-left'>\n\
                                                                                    <a href='"+childData['resUrl']+"'>"+childData['resName']+"</a> \n\
                                                                                    \n\
                                                                                  </div>\n\
                                                                                  <div class='col-1 '><button id = 'btEdit' style='border:none;background-color:transparent;color:rgba(255,255,255,0.7);' onclick='deleteFiles(\""+filePath+"\",\""+childKey+"\",\""+childData['resName']+"\")' ><span class = 'fa fa-trash'></span></button>\n\</div>\n\
                                                                                </div><hr style='margin:1px;background-color:rgba(255,255,255,0.1);'>";
                        }
                      }
        });
        document.getElementById("divUserFiles").innerHTML=htmlContent
      });
    }

    function deleteFiles(filePath,fileKey,fileName){
      console.log("filePath: " +filePath+"\n dataPath: "+filePath+fileName);
             database.ref(filePath+fileKey).remove();
             loadUserFiles(this.currentDepKey,this.userID);

        
    }
    function checks(){
      /*for(var i=0;i<10;i++){
        console.log("ds");
        var tempkey=database.ref("resources/").push().key;
        database.ref("resources/"+tempkey+"/").set({
        depName:""
            

          
          });     
      }*/
    }


function loadHomeData(){
    var path= "resources/";
      database.ref(path).once('value',function(snapshot){

        snapshot.forEach(function(childSnapshot){
          var childData = childSnapshot.val();
          var childKey=childSnapshot.key;
  document.getElementById("resHere").innerHTML+=" <div class = 'row' >\n\
                                       <div class = 'col'>\n\
             <small> <a href='viewFiles.php?depKey="+childKey+"'>"+ childData['depName']+" \n\
              </a></small>\n\
                                        </div>\n\
                                    </div><hr style='background-color:rgba(255,255,255,0.2);'>";

          });

      });
  
}
</script>