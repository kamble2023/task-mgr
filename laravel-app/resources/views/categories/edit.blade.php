@include('layout.header')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/categories/list"> Back</a>
            </div>
        </div>
    </div>
    <div class="col-lg-12 margin-tb">
    <form name="edit" id="edit" action="" method="POST">
    <input type="hidden" name="category_id" value=" {{ $category->id }}">
    @csrf
  
     <div class="row">
        <div class="alert alert-danger" id="error-msg" style="display:none"></div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value=" {{ $category->name }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
           
        </div>
        </div>
        <div class="row">

                <div class="col-xs-3 col-sm-3 col-md-3">

                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">       
                </div>
            
            </div>
        
        </form>
</div>   
      
<script>
      $(document).ready(function () {
        
        $("#edit").submit(function(e){
          e.preventDefault(); 
          var form_data = $('#edit').serialize();
          $.ajax({
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer " + token
                },
                url:API_URL+'category/update',
                //data:{_token : $('meta[name="csrf-token"]').attr('content'), form_data},
                data:form_data,
                success:function(data) { 
                  if(!data.success){
                    $("#error-msg").html(data.message);
                  }else{
                    $("#error-msg").removeClass("alert-danger");
                    $("#alert-success").addClass("alert-danger");
                    $("#error-msg").show();
                    $("#error-msg").html(data.message);
                    setTimeout(function(){ 
                        $("#error-msg").hide(); 
                        window.location.href = APP_URL+ "categories/list";   
                    }, 3000);

                     
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
    });
    </script>

@include('layout.footer')