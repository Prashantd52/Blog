@extends('layouts.app')
@section('content')
   <div class="container">
        <div class="card">
            <h2 class="card-title">&emsp; Edit Category</h2>
            <div class="card-body">
                    <form action="/category/update/{{$category->id}}" method="post">
                    @csrf
                    @method('put')
                <div class="form-group">
                    <label>Category name</label>
                    <input class="form-control" name="name" type="text" value="{{$category->name}}" ><br><br>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" >{{$category->description}}</textarea><br>
                </div>
                <div>
                    <button class="btn btn-success" type="update"> Update</button>
                    <a class="btn btn-info" href='/category/categories'>back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection