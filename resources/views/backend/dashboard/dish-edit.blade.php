@extends('backend.dashboard.app')

@section('main')
<div id="page-wrapper">
			<div class="main-page">
				<div class="forms">
					<h2 class="title1">Edit Dish</h2>
					
					<div class="form-two widget-shadow">
						<div class="form-body" data-example-id="simple-form-inline">
							<form id="editDish" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="title">Select Category &nbsp;</label>
                                    <select name="category_id" class="form-group">
                                            @if($categoryList)
                                            @foreach($categoryList as $category)
                                            <option @if($dish->category_id==$category->id) selected  @endif  value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                            @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $dish->title }}" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Image</label>
                                    <input type="file" name="image" value="{{ $dish->image }}" /><br>
                                    <img title="{{ $dish->image }}" alt="{{ $dish->image }}" src="{{url('uploads/'.$dish->image)}}" width="50" height="50">
                                    <span>{{ $dish->image }}</span>
                                    <input type="hidden" name="old_image" value="{{ $dish->image }}" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Description</label>
                                    <input type="text" name="description" class="form-control" value="{{ $dish->description }}" />
                                </div>
                                <div class="form-group">
                                    <label for="title">Price</label>
                                    <input type="text" name="price" class="form-control" value="{{ $dish->price }}" />
                                </div>
                                <button type="submit" class="btn btn-success">Edit</button>
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
           $('#editDish').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $.ajax({
              type:'POST',
              url: "{{ route('admin.dish-update',[$dish->id]) }}",
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