<h4><b>
@if(!empty($role_type))    
{{$role_type->role_type}}:
@endif
</b></h4><br>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Table Name</th>
            <th>Add</th>
            <th>Edit </th>
            <th>Delete</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($permissionDetails))
    @foreach($permissionDetails as $permission)
    @if(!empty($permission->menu_id))
        <tr>
        @if(!empty($permission->menu))
            <th scope="row">{{$permission->menu}}</th>
        @endif
        <td>
        @if(!empty(Str::contains($permission->permission,1)))
            <i class="fa fa-check"></i>
        @endif
        </td>
        <td>
            @if(!empty(Str::contains($permission->permission,2)))
            <i class="fa fa-check"></i>
            @endif
        </td>
        <td>@if(!empty(Str::contains($permission->permission,3)))
            <i class="fa fa-check"></i>
            @endif
        </td>
        <td>@if(!empty(Str::contains($permission->permission,4)))
            <i class="fa fa-check"></i>
            @endif
        </td>
        </tr>
        @endif
        @endforeach
    @endif
    </tbody>
</table>
