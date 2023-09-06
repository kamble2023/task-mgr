
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id = "Profile" name="Profile" method="POST" action="">
        <input type="hidden" name="user_id" id="user_id" value="">
        <div class="form-floating">
        <input type="text" name ="name" class="form-control" id="name" placeholder="Name" value="">
        <label for="floatingInput">Name</label>
        </div>

        <div class="form-floating">
        <input type="email" name ="email" class="form-control" id="email" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        </div>

  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="update" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal-->

<script>

    var token = "";
    if(localStorage.getItem("token") != ""){
        token = localStorage.getItem("token");
    }

</script>


</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->


    <script>
        $(document).ready(function () {
            const token = localStorage.getItem("token");
            const user_name = localStorage.getItem("userName");
                        console.log("LS Token## " + token + " --user_name--"+ user_name);
            $('#uName').html(user_name);                        
        });

        $("#logout").click(function(){
            localStorage.setItem("token", "");
            window.location.href = APP_URL; 
        });

        $("#profile").click(function(){
            var form_data = $('#add').serialize();
          $.ajax({
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer " + token
                },
                url:APP_URL+'user/profile',
                //data:{_token : $('meta[name="csrf-token"]').attr('content'), form_data},
                data:form_data,
                success:function(data) { 
                    $("#exampleModal").modal("show");
                    
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#user_id").val(data.id);
                },
                error:function (data) {
                    console.log(data.responseJSON.message);
                    $("#error-msg").show();
                    $("#error-msg").html(data.responseJSON.message);
                    setTimeout(function(){ $("#error-msg").hide(); }, 3000);
                },
              });
        });

        $(document).on("click","#update",function() {
            var form_data = $('#Profile').serialize();
            $.ajax({
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer " + token
                },
                url:API_URL+'profile/update',
                data:form_data,
                success:function(data) { 
                  if(!data.success){
                    $("#error-msg").html(res_data.message);
                    setTimeout(function(){ $("#error-msg").hide(); }, 3000);
                  }else{
                    console.log("token# " +data.data.token);
                    console.log("msg# " +data.message);
                    console.log("succ# " +data.success);
                    localStorage.setItem("userName", data.data.name);
                    const token = localStorage.getItem("token");
                    $("#exampleModal").modal("show");
                    window.location.href = APP_URL+ "dashboard";   
                  }
                  
                },
                error:function (data) {
                    console.log(data.responseJSON.message);
                    $("#error-msg").show();
                    $("#error-msg").html(data.responseJSON.message);
                    setTimeout(function(){ $("#error-msg").hide(); }, 3000);
                },
              });
        });
    </script>

</body>
</html>