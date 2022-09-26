<h4><b>
@if(!empty($role_type))    
{{$role_type->role_type}}:
@endif
</b></h4>
<br>
<div class="form-body" data-example-id="simple-form-inline">
    <form id="editPermission" class="form-inline" method="POST">
        @csrf
        @if(!empty($adminMenu))
        @php
        $k=1;
        @endphp
        @foreach($adminMenu as $menu)
        @if(!empty($menu->menu_id))
        <div class="form-group">
            <label for="title"><b>{{$menu->menu}}&nbsp;</b></label>
            <input type="hidden" value="{{$menu->permission_id}}" name="permission_id{{$k}}">
            <input type="hidden" value="{{$k}}" name="menu_count[]">
            <div class="checkbox">
                <label for="title"><input type="checkbox" class="form-check-input" value="1" name="permission{{$k}}[]" @if(!empty(Str::contains($menu->permission,1))) checked @endif>
                    Add
                </label>
            </div>
            <div class="checkbox">
                <label for="title"><input type="checkbox" class="form-check-input" value="2" name="permission{{$k}}[]" @if(!empty(Str::contains($menu->permission,2))) checked @endif>
                    Edit
                </label>
            </div>
            <div class="checkbox">
                <label for="title"><input type="checkbox" class="form-check-input" value="3" name="permission{{$k}}[]" @if(!empty(Str::contains($menu->permission,3))) checked @endif>
                    Delete
                </label>
            </div>
            <div class="checkbox">
                <label for="title"><input type="checkbox" class="form-check-input" value="4" name="permission{{$k}}[]" @if(!empty(Str::contains($menu->permission,4))) checked @endif>
                    View
                </label>
            </div>
        </div><br><br>
        @php
        $k++;
        @endphp
        @endif
        @endforeach
        <button type="submit" class="btn btn-info">Update </button>
        @endif
    </form>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#editPermission').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "{{ route('admin.permission-update') }}",
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
          