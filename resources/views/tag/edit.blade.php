@extends('layouts.app')
@section('content')
   <div class="container">
        <div class="card">
            <h2 class="card-title">&emsp; Edit Tag</h2>
            <div class="card-body">
                    <form action="/tag/update/{{$tag->slug}}" method="post">
                     @csrf
                     @method('put')   
                <div class="form-group">
                    <label>Tag name</label>
                    <input class="form-control" name="name" type="text" value="{{$tag->name}}"><br><br>
                </div>
                <div>
                    <button class="btn btn-success" type="update"> Update</button>
                    <a class="btn btn-info" href='/tag/tag_list'>back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection