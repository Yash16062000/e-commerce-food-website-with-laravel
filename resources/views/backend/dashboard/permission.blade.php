@extends('backend.dashboard.app')

@section('main')
<div id="page-wrapper">
	<div class="main-page">
        <h2 class="title1">Permissions</h2>
        @if(Auth::user()->user_type==1)
        <div class="forms">
            <div class="form-two widget-shadow">
                <div class="form-body" data-example-id="simple-form-inline">
                    <form id="addPermission" class="form-inline" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title"><b> Role &nbsp;</b></label>							
                            <select name="role_id" class="form-group">
                                <option value="0">Select Role</option>
                                @if($roleList)
                                @foreach($roleList as $role)
                                <option value="{{$role->id}}">{{$role->role_type}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div><br><br>
                        @if($adminMenu)
                        @php
                        $k=0;
                        @endphp
                        @foreach($adminMenu as $menu)
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="title"><input type="checkbox" onclick="checkMe('{{$k}}')" id="menu_id{{$k}}"  value="{{$menu->id}}" name="menu_id{{$k}}"><b>&nbsp;{{$menu->menu}}&nbsp;</b></label>
                            </div>
                            <input type="hidden" value="{{$k}}" name="menu_count[]">
                            <div id="options{{$k}}" style="display: none;">
                            <div class="checkbox" >
                                <label for="title"><input type="checkbox" value="1" name="permission{{$k}}[]">
                                    Add
                                </label>
                            </div>
                            <div class="checkbox">
                                <label for="title"><input type="checkbox" value="2" name="permission{{$k}}[]">
                                    Edit
                                </label>
                            </div>
                            <div class="checkbox">
                                <label for="title"><input type="checkbox" value="3" name="permission{{$k}}[]">
                                    Delete
                                </label>
                            </div>
                            <div class="checkbox">
                                <label for="title"><input type="checkbox" value="4" name="permission{{$k}}[]">
                                    View
                                </label>
                            </div>
                        </div>
                    </div>
                        <br><br>
                        @php
                        $k++;
                        @endphp
                        @endforeach
                        @endif
                        <button type="submit" class="btn btn-info">Save </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addPermission').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "{{ route('admin.permission_store') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
        this.reset();
        window.location.href="{{ route('admin.all-roles') }}"
        }
    });
    });

    function checkMe(k){
        var menu_id = document.getElementById("menu_id"+ k);
        var options = document.getElementById("options"+k);
        if(menu_id.checked==true){
            options.style.display="block";
        }
        else{
            options.style.display="none";
        }
    }
</script>
@endsection