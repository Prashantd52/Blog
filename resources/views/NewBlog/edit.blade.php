@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <br>
        <form action="/newblog/update/{{$blog->id}}" method="post">
            @csrf()
            @method('put')
            <div class="row">
                <h3 class="card-title">&emsp;Edit Blog</h3>
                <div class="card-body">
                    <label>Title</label>
                    <input type="text" class="form-control" name="name" value="{{$blog->name}}"><br><br>
                    <div class="row">
                        <label>Choose Categories</label>&emsp;
                        <select class="form-select" name="category"  aria-label="Default select example">
                            <option selected value="{{$blog->category->id}}">{{$blog->category->name}}</option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>              
                    </div><br>  
                    <div class="row">
                        <label>Choose Tags</label>&emsp;
                        <select class="form-select" name="tags[]" multiple aria-label="Default select example">
                            @foreach($tags as $tag)
                            <option
                            @foreach($blog->tags as $t)
                            @if($t->id==$tag->id) selected @endif
                            @endforeach
                            value="{{$tag->id}}"">{{$tag->name}}</option>            
                            @endforeach
                        </select>              
                    </div><br>                  
                </div>
            </div>
            <br>
            <br>
            <br>
            <h3 class="card-title">&emsp;Write content here</h3>
            <div class="card-body">
                    
                 <div class="formgroup">
                    <textarea class="form-control" name="content" >{{$blog->content}}</textarea><br>
                    <button class="btn btn-success col-1" type="submit">Update</button>
                    <a class="btn btn-outline-dark" href="/newblog/blogs" >Cancel</a>
                </div>
            </div>  
        </form>
    </div>
</div>
@endsection