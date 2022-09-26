@extends('backend.dashboard.app')

@section('main')
<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Forms</h2>
					
					<div class="form-two widget-shadow">
						<div class="form-title">
							<h4>Add Category :</h4>
						</div>
						<div class="form-body" data-example-id="simple-form-inline">
							<form class="form-inline" action="{{ route('admin.category-store') }}" method="POST"> @csrf 
								<div class="form-group"> 
									<label for="title">Dish Name&nbsp;</label>
									<input type="text" name="title" class="form-control" value="{{ old('title')}}" />
								 </div>
								<button type="submit" class="btn btn-success">Add </button>
							 </form> 
						</div>
					</div>
					
					
				</div>
			</div>
		</div>
@endsection