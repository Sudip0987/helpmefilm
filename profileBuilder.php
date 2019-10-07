

<!--including the js file with all the firebase functions-->
<?php include ('includes/firebase.html') ?>
      
       <form>
       <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog"  style = "width:70%; background-color:black; color:black;">
             <div class="modal-content" style='background-color:#23272A;color:rgba(255,255,255,0.9);'>
                <div class="modal-header">
                   <h5 >Add Role</h5>

                   <input type="hidden" id = "roleKey"/>
                </div>
                <div class="modal-body" >
                   
                      <div class="form-group col-md-12" >
                         <p>Job Title</p>
                         <input type = "text" required class = "form-control" style='border:1px solid rgba(255,255,255,0.2);background-color: transparent;color:rgba(255,255,255,0.8);'  name ="role" id="role"/>
                      </div>
                      <div class="form-group col-md-12">
                         <p>Company Name</p>
                         <input type = "text" required class = "form-control" style='border:1px solid rgba(255,255,255,0.2);background-color: transparent;color:rgba(255,255,255,0.8);'  name = "companyName" id="companyName"/>
                      </div>
                   <div class = "form-group col-md-12">
                       <div class = "row">
                         <div class = "col-md-6">
                            From
                            <input type = "month" required class = "form-control" style='border:1px solid rgba(255,255,255,0.2);background-color: transparent;color:rgba(255,255,255,0.8);' name ="inputFrom" id="inputFrom"/>
                         </div>
                         <div class = "col-md-6">
                            To  
                            <input type = "month" required class = "form-control" style='border:1px solid rgba(255,255,255,0.2);background-color: transparent;color:rgba(255,255,255,0.8);'  name = "inputTo" id="inputTo"/> 
                         </div>
                      </div>
                  
                   </div>

                    <div class="form-group col-md-12">
                       <p>Role Description</p>
                       <textarea class = "ck"  style="min-width: 100%;" name="editor" id="editor" rows="3" ></textarea>
                    </div>
                    <div class="form-group col-md-12">
                       <div class = "row">
                          <div class = "col-md-6">
                          	<input type = "hidden" id = "userID" name = "userID" value = "<?php echo($_SESSION['userID']); ?>" />
                             <input type = "submit" value="Add Role"  id = "btAdd" class="btn btn-warning text-dark btn-banner btn-block" onClick="addRole(document.getElementById('companyName').value,document.getElementById('role').value,document.getElementById('inputFrom').value,document.getElementById('inputTo').value,CKEDITOR.instances.editor.getData(),document.getElementById('userID').value)" />
                            
                          </div>
                          <div class  = "col-md-6">
                             <button id = "btClose" class="btn btn-warning text-dark btn-banner btn-block" data-dismiss="modal" >Cancel</button>
                          </div>
                       </div>
                    </div>
                </div>
             </div>
          </div>
       </div>
    </form>

    <script>
        CKEDITOR.replace('editor');


    </script>
