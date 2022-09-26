@extends('backend.dashboard.app')

@section('main')
<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Edit Category</h2>
					
					<div class="form-two widget-shadow">
						<div class="form-body" data-example-id="simple-form-inline">
							<form class="form-inline" action="{{ route('admin.category-update',[$category->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group"> <label for="title">Dish Name</label><input type="text" name="title" id="" class="form-control" value="{{ $category->title }}" /> </div>
                            <button type="submit" class="btn btn-success">Update</button> </form> 
						</div>
					</div>
					
					
				</div>
			</div>
		</div>

@endsection