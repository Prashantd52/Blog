@extends('layouts.app')
@php
$index=1;
@endphp
@section('content')
<div class="container">
    <h2 class="card-title pl-2">User and their roles</h2>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th>#</th>
            <th>Name</th>
            <th>Role</th>
            <th><div  class=" d-flex justify-content-center text-center">
                Options
                </div>
            </th>
            </tr>
            @foreach($users as $user)
                <tr>
                <td>{{$index++}}</td>
                <td>{{$user->name}}</td>
                <td>
                @foreach($user->roles as $role)
                <span class="badge badge-info">{{$role->display_name}}</span>
                @endforeach</td>
                <td>
                <div  class=" d-flex justify-content-center text-center">
                <a class="btn btn-outline-danger text text-center" href="{{route('e.user_role',$user->id)}}">Edit</a></td>
                </div>
                </tr>
            @endforeach
            </tr>
        </table>
    </div>
</div>
@endsection