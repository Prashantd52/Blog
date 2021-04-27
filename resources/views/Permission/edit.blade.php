@extends('layouts.app')
@section('content')
<div class="container">
    <div class="title">
        <h1>Edit Permissions</h1>
    </div>
    <div class="card pl-3 pt-2 pr-3">
    <form action="{{route('u.permission',$permission->id)}}" method="post">
    @csrf()
    @method('put')
        <div class="row form-group pl-3">
            <label >Name</label>&emsp;
            <input  type="text" name="name" placeholder="enter permission name" value="{{$permission->name}}" readonly>&emsp;
            <label>Display Name</label>&emsp;
            <input  type="text" name="display_name" placeholder="Name to be displaced" value="{{$permission->display_name}}" required>
        </div>
        <label>Description of role</label>
        <textarea class="form-control" name="description">{{$permission->description}}</textarea>
        <br>
        <button class="btn btn-success" type="submit"> Update </button>
        <a class="btn btn-info" href="{{route('i.permission')}}">back</a>
        </form>
        <br>
    </div>
</div>
@endsection