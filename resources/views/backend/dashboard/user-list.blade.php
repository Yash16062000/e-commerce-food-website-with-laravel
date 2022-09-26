@extends('backend.dashboard.app')

@section('main')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div id="page-wrapper">
    <div class="main-page">
    <div class="tables">
    <h2 class="title1">Customer List</h2>
        <div class="panel-body widget-shadow">
            @if(session()->has('success'))
                <div class="alert alert-info" role="alert"><strong>{{ session()->get('success') }}</strong></div>
            @endif
            <!-- permission checker for add Customer permission starts -->
            @if(Auth::user()->user_type!=1)
                @php 
                $check = Helper::checkOperation(Auth::user()->user_type,1,1);
                if(!empty($check)) {
                @endphp
                <a class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Customer</a><br>
                @php
                }
                @endphp

                @else
                <a class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Customer</a><br>
                
              @endif
              <!-- permission checker for add Customer permission ends -->
                
        <table class="table table-hover user-datatable">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
       
    </div><br>
    </div>
    </div>
</div>

<!-- add customer modal starts -->
<div id="addCustomerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create User </h4>
      </div>
      <div class="modal-body">
        <div class="panel-body widget-shadow"> 
           
        <form id="addCustomer" method="POST"> 
            @csrf 
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="name" class="form-control" /><br>
            </div>
            <div class="form-group">
                 <label for="title">Email&nbsp;</label>
                 <input type="email" name="email" id="" class="form-control" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" /><br>
            </div>
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" /><br>
                <input type="hidden" value="2" name="user_type" class="form-control" /><br>
            </div>
            <button type="submit" class="btn btn-success">Add </button> 
        </form>
      
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- add customer modal ends -->

  <!-- edit customer modal starts -->
<div id="editCustomerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User </h4>
      </div>
      <div class="modal-body">
        <div class="panel-body widget-shadow"> 
           
        <div id="edituserDetails"></div>
    </div>
  </div>
  </div>
  </div>
  </div>

  <!-- edit customer modal ends -->
<!-- datatable scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.user-datatable').DataTable({
        processing: true,
        serverSide: true,		
        ajax: "{{ route('admin.getuser-list') }}",
        columns: [
			{data: 'id', name: 'id',orderable: true, searchable: true},
            {data: 'name', name: 'name',orderable: true, searchable: true},
            {data: 'email', name: 'email',orderable: true, searchable: true},
			{data: 'created_at', name: 'created_at',orderable: true, searchable: true},
			{data: 'action', name: 'action' }
        ]
    });
});

function RemoveUser(user_id){
    alert("Are you Sure You want to delete this user?");
    var data = "user_id="+user_id;
    $.ajax({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'GET',
        url: "{{ route('admin.remove_user') }}",			  
        data:data,              
        success: (response) => {
        window.location.reload();
        }
    });
    }

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           $('#addCustomer').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $.ajax({
              type:'POST',
              url: " {{route('addUser')}} ",
              data: formData,
              contentType: false,
              processData: false,
              success: (response) => {
                if (response) {
                this.reset();
                window.location.href="{{ route('admin.user-list') }}"
                }
               }
           });
    });

    function EditUserInfo(user_id){   
      var data = "user_id="+user_id;
      //alert(data);
      $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'GET',
        url: "{{ route('admin.edit-user-details') }}",			  
        data:data,              
        success:  function (response) {       
          $('#edituserDetails').html(response);        
        }  
      });
    }
</script>
 

@endsection