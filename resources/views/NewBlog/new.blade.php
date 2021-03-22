@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <br>
        <form action="/newblog/store" method="post">
            @csrf()
            <div class="row">
                <h3 class="card-title">&emsp;Write new Blog</h3>
                <div class="card-body">
                    <label>Title</label>
                    <input type="text" class="form-control " name="name" required><br><br>
                    <div class="row">
                        <label>Choose Categories</label>&emsp;
                        <select class="js-example-basic-single form-select col-5" name="category"  aria-label="Default select example">
                            <option selected>---select category---</option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>              
                    </div><br>
                    <div class="row">
                        <label>Choose Tags</label>&emsp;&emsp;&emsp;&emsp;
                        <select class="js-example-basic-multiple form-control col-5" name="tags[]" multiple aria-label="Default select example">
                            <option selected>select tags</option>
                            @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
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
                    <textarea class="form-control" name="content" required></textarea><br>
                    <button class="btn btn-success col-1" type="submit"> Submit</button>
                    <a class="btn btn-outline-dark" href="{{route('list.blog')}}" >Cancel</a>
                </div>
            </div>  
        </form>
    </div>
</div>
@endsection