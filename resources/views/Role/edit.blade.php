@extends('layouts.app')
@section('content')
<div class="container">
    <div class="title">
        <h1>Edit Role</h1>
    </div>
    <div class="card pl-3 pt-2 pr-3">
        <form  action="{{route('u.role',$role->id)}}" method="post">
        @csrf()
        @method('put')
        <div class="row form-group pl-3">
            <label >Name</label>&emsp;
            <input  type="text" name="name" value="{{$role->name}}" placeholder="enter role name" readonly>&emsp;
            <label>Display Name</label>&emsp;
            <input  type="text" name="display_name" value="{{$role->display_name}}" placeholder="Name to be displaced">
        </div>
        <div class="row form-group pl-3">
            <label>Permissions</label>&emsp;
            <select name="permissions[]" class="js-example-basic-multiple form-control col-6" multiple>
            @foreach($permissions as $permission)
            <option 
            @foreach($role->permissions as $pr)
            @if($pr->id==$permission->id)
            selected  
            @endif
            @endforeach
            value="{{$permission->id}}">{{$permission->display_name}}</option>
            @endforeach
            </select>
        </div>
        <label>Description of role</label>
        <textarea name="description" class="form-control">{{$role->description}}</textarea>
        <br>
        <button class="btn btn-success" type="submit"> Update</button>
        <a class="btn btn-info" href="{{route('i.role')}}">back</a>
        </form>
        <br>
    </div>
</div>
@endsection