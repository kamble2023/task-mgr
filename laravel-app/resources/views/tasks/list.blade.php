@include('layout.header')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List Tasks</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/task/add"> Create New Taks</a>
            </div>
        </div>
    </div>
   
    <!-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif -->
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th width="280px">Action</th>
        </tr> 
        @if(count($tasks) > 0)

      
        @foreach ($tasks as $task)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ date("m/d/Y", strtotime($task->start_date)) }}</td>
            <td>{{ date("m/d/Y", strtotime($task->end_date)) }}</td>
           
            <td>
                <form action="/task/destroy/$task->id" method="POST">
   
                    <a class="btn btn-info" href="/task/show/{{ $task->id }}">Show</a>
    
                    <a class="btn btn-primary" href="/task/edit/{{ $task->id }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="button" class="btn btn-danger delete_task"  value="{{ $task->id }}">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
            <tr> <td colspan=3 align="center">No data found </td></tr>
        @endif 
    </table>
    {!! $tasks->links() !!}
   
      
<script>
    $(document).ready(function () {
            
        $('.delete_task').click(function() { 
       
            var task_id = $(this).val();
            $.ajax({
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization": "Bearer " + token
                    },
                    url:API_URL+'task/delete',
                    //data:{_token : $('meta[name="csrf-token"]').attr('content'), form_data},
                    data:{"task_id":task_id},
                    success:function(data) { 
                    if(!data.success){
                        $("#error-msg").html(data.message);
                    }else{
                        
                        window.location.href = APP_URL+ "task/list";   
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