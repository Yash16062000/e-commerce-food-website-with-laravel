@extends('backend.dashboard.app')

@section('main')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
                    @if(session()->has('success'))
                      <div class="alert alert-info" role="alert"><strong>{{ session()->get('success') }}</strong></div>
                    @endif 
					<h2 class="title1">Dish List</h2>
					<div class="panel-body widget-shadow">
						<!-- permission checker for add dish starts -->
						@if(Auth::user()->user_type!=1)
							@php 
							$check = Helper::checkOperation(Auth::user()->user_type,2,1);
							if(!empty($check)) {
							@endphp
							<a class="btn btn-primary" href="{{ route('admin.add-dish') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Dish</a><br>
							@php
							}
							@endphp

							@else
							<a class="btn btn-primary" href="{{ route('admin.add-dish') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Dish</a><br>
							
						@endif

						<!-- permission checker for add dish ends -->
						<table class="table table-hover dish-datatable">
							<thead>
								<tr>
								  <th>S.No</th>
								  <th>Dish Name</th>
								  <th>Category</th>
                                  <th>Image</th>
                                  <th>Description</th>
								  <th>Price</th>
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

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
   <script type="text/javascript">
  $(function () {
    
    var table = $('.dish-datatable').DataTable({
        processing: true,
		dom: "Bfrtip",
        serverSide: true,		
        ajax: "{{ route('admin.getproduct-list') }}",
        columns: [
			{data: 'id', name: 'id',orderable: true, searchable: true},
            {data: 'title', name: 'title',orderable: true, searchable: true},
            {data: 'category_id', name: 'category_id',orderable: true, searchable: true},
			{data: 'image', name: 'image'},
			{data: 'description', name: 'description',orderable: true, searchable: true},
			{data: 'price', name: 'price',orderable: true, searchable: true},
			{data: 'action', name: 'action' }
        ]
    });
    
  });
  </script>
@endsection