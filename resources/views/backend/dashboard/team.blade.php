@extends('backend.dashboard.app')

@section('main')
<div id="page-wrapper">
    <div class="main-page">
        <div class="tables">
        <h2 class="title1">Team</h2>
            <div class="panel-body widget-shadow">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Role Type</th>
                            <th >Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($team as $menu)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{$menu->role_type}}</td>
                            <td>{{ucwords($menu->name)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection