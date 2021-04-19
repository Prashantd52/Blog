@extends('layouts.app')
@section('content')
@php
$index=1;
@endphp
<div class="container">
    <h2 >Permissions &nbsp;<a href="{{route('c.permission')}}">+</a></h2>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th>#</th>
            <th>Name</th>
            <th>Display Name</th>
            <th>Description</th>
            <th><div  class=" d-flex justify-content-center text-center">
                Options
                </div>
            </th>
            </tr>
            @foreach($permissions as $permission)
                <tr>
                <td>{{$index++}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->description}}</td>
                <td>
                <div  class=" d-flex justify-content-center text-center">
                <a class="btn btn-outline-danger text text-center" href="{{route('e.permission',$permission->id)}}">Edit</a></td>
                </div>
                </tr>
            @endforeach
            </tr>
        </table>
    </div>
</div>
@endsection