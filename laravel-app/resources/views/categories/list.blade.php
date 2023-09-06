@include('layout.header')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List Categories</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/category/add"> Create New Category</a>
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
            <th width="280px">Action</th>
        </tr> 
        @if(count($categories) > 0)

      
        @foreach ($categories as $category)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $category->name }}</td>
           
            <td>
                <form action="/category/destroy/$category->id" method="POST">
   
                    <a class="btn btn-info" href="/category/show/{{ $category->id }}">Show</a>
    
                    <a class="btn btn-primary" href="/category/edit/{{ $category->id }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="button" class="btn btn-danger delete_cat"  value="{{ $category->id }}">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
            <tr> <td colspan=3 align="center">No data found </td></tr>
        @endif 
    </table>
    {!! $categories->links() !!}
   
      
<script>
    $(document).ready(function () {
            
        $('.delete_cat').click(function() { 
       
            var cat_id = $(this).val();
            $.ajax({
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization": "Bearer " + token
                    },
                    url:API_URL+'category/delete',
                    //data:{_token : $('meta[name="csrf-token"]').attr('content'), form_data},
                    data:{"cat_id":cat_id},
                    success:function(data) { 
                    if(!data.success){
                        $("#error-msg").html(data.message);
                    }else{
                        
                        window.location.href = APP_URL+ "categories/list";   
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