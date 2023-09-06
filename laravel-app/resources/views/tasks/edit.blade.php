@include('layout.header')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add Task</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/task/list"> Back</a>
            </div>
        </div>
    </div>
    <div class="col-lg-12 margin-tb">
    <form name="edit" id="edit" action="" method="POST">
    <input type="hidden" name="task_id" value=" {{ $task->id }}">
    @csrf
  
     <div class="row">
        <div class="alert alert-danger" id="error-msg" style="display:none"></div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group"> 
                <strong>Category:</strong>
                <select id="category_id" name="category_id" class="form-control">
                    @foreach($categories as $category)    
                     @if($category->id == $task->category_id)
                     <option value="{{ $category->id}}" selected> {{ $category->name}} </option> 
                     @endif            
                    <option value="{{ $category->id}}"> {{ $category->name}} </option>            
                    @endforeach
                    </select> 

            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
           
        </div>
        </div>
        <div class="row">
        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value=" {{ $task->title }} ">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
           
        </div>
        </div>

        <div class="row">

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea name="description" id="description" class="form-control"> {{ $task->description }} </textarea>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
           
        </div>
        </div>

        <div class="row">
        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Start Date:</strong>
                <!-- <input type="text" name="start_date" id="start_date" class="form-control" data-provide="datepicker"> -->
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" name="start_date" id="start_date" class="form-control" value=" {{  date('d/m/Y', strtotime($task->start_date)) }} ">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
           
        </div>
        </div>
        
        <div class="row">
        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>End Date:</strong>
                <!-- <input type="text" name="end_date" id="end_date" class="form-control"> -->
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" name="end_date" id="end_date" class="form-control" value=" {{ date('d/m/Y', strtotime($task->end_date)) }} ">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>



            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
           
        </div>
        </div>        


        <div class="row">

                <div class="col-xs-3 col-sm-3 col-md-3">

                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">       
                </div>
            
            </div>
        
        </form>
</div>   
      
<script>
      $(document).ready(function () {
        
       $('#start_date').datepicker({
        format: "dd/mm/yyyy"
        }).on('change', function(){
            $('.datepicker').hide();
            var startDate = new Date($(this).val());
            $('#end_date').datepicker('startDate', startDate);
        }).on('clearDate', function (selected) {
            $('#end_date').datepicker('startDate', null);
        });

        $('#end_date').datepicker({
        format: "dd/mm/yyyy"
        }).on('change', function(){
            $('.datepicker').hide();
           
        }).on('clearDate', function (selected) {
           
        });
  
        $("#edit").submit(function(e){
          e.preventDefault(); 
          var form_data = $('#edit').serialize();
          $.ajax({
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Authorization": "Bearer " + token
                },
                url:API_URL+'task/update',
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
                        window.location.href = APP_URL+ "task/list";   
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