@extends('backend.dashboard.app')

@section('main')
<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Add Dish</h2>
					
					<div class="form-two widget-shadow">
						<div class="form-title">
							<h4>Add Dish: </h4>
						</div>
						<div class="form-body" data-example-id="simple-form-inline">
							<form id="addDish" method="POST"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Select Category &nbsp;</label>
                                    <select name="category_id" class="form-group">
                                        <option value="0">&nbsp;Parent</option>
                                            @if($categoryList)
                                            @foreach($categoryList as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                            @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Image</label>
                                    <input type="file" name="image" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Description</label>
                                    <input type="text" name="description" class="form-control" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Price</label>
                                    <input type="text" name="price" class="form-control" value="" />
                                </div>
                                <button type="submit" class="btn btn-success">Add</button>
                            </form> 
						</div>
					</div>
					
					
				</div>
			</div>
		</div>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           $('#addDish').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $.ajax({
              type:'POST',
              url: "{{ route('admin.dish-store') }}",
              data: formData,
              contentType: false,
              processData: false,
              success: (response) => {
                if (response) {
                this.reset();
                window.location.href="{{ route('admin.all-dishes') }}"
                }
               }
           });
    });

        </script>

@endsection