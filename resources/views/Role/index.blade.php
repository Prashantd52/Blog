@extends('layouts.app')
@section('content')
@php
$index=1;
@endphp
<div class="container">
    <div class="card">
        <br>
        <div class="row">
            <h2 class="card-title pt-2">&emsp;Role List
            <a href="{{route('c.role')}}">+</a></h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered" >
            <thead>
            <tr>
            <th> Sr.no.</th>
            <th> Name</th>
            <th> Display Name</th>
            <th style="width:20%" > Permissions</th>
            <th> description</th>
            <th style="text-align:center;">Options</th>
            </tr></thead>
            <tbody>
            @foreach($roles as $role)
            <tr>
            <td >{{$index++}}</td>
            <td >{{$role->name}}</td>
            <td >{{$role->display_name}}</td>
            <td style="width:20%" >
            @foreach($role->permissions as $permission)
            <span class="badge badge-info">{{$permission->display_name}}</span> 
            @endforeach</td>
            <td >{{$role->description}}</td>
            <td >
            <div class="row d-flex justify-content-center" >
                <a class="btn btn-outline-info " href="{{route('e.role',$role->id)}}">Edit</a>&emsp;         
                <form action="{{route('d.role',$role->id)}}" method="post">
                @csrf()
                @method('delete')
                <button class='btn btn-danger ' type="submit">Delete</button>
                </form>
            </div>
            
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection