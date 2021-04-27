@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Roles of the User</h1>
    <form action="{{route('u.user_role',$user->id)}}" method="post">
    @csrf
    @method('put')
    <div class="row pl-3">
        <div class="col-5">
            <label >User Name</label>&emsp;
            <input type="text" readonly value="{{$user->name}}">
        </div>
        <br>
    </div>
    <div class="row pl-3">
        <div class="col-6">
        <label for="exampleInputEmail1">Roles</label>
        <select name="roles[]" class="js-example-basic-multiple form-control" multiple >
        <option value="">--select role--</option>
        @foreach($roles as $role)
        <option 
        @foreach($user->roles as $r)
        @if($r->id==$role->id)
        selected  
        @endif
        @endforeach
        value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
        </select>
        </div>
    </div>
    <br>
    <button class="btn btn-success">update</button>
    <a class="btn btn-primary" href="{{route('i.user_role')}}">cancel</a>
    </form>
</div>
@endsection