<form id="addRoles"  method="post" enctype="multipart/form-data"> 
@csrf 
    <div class="form-group"> 
    <label for="title">Name&nbsp;</label>
    <input type="text" name="name" class="form-control"/> 
    </div>
    <div class="form-group"> 
    <label for="title">Email&nbsp;</label>
    <input type="text" name="email" class="form-control"/> 
    </div>
    <div class="form-group"> 
    <label for="title">Password&nbsp;</label>
    <input type="password" name="password" class="form-control"/> 
    </div>
    <div class="form-group"> 
    <label for="title">Confirm Password&nbsp;</label>
    <input type="password" name="password_confirmation" class="form-control"/> 
    <input type="hidden" value="{{$role}}" name="user_type" class="form-control" /><br>
    </div>
    <button type="submit" class="btn btn-success">Register </button> 
</form>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addRoles').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "{{ route('admin.addAdmin') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
        this.reset();
        window.location.href="{{ route('admin.all-roles') }}"
        }
    });
    });
</script>