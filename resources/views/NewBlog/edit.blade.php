@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <br>
        <form action="/newblog/update/{{$blog->slug}}" method="post"  enctype="multipart/form-data">
            @csrf()
            @method('put')
            <div class="row">
                <h3 class="card-title">&emsp;Edit Blog</h3>
                <div class="card-body">
                    <label>Title</label>
                    <input type="text" class="form-control " name="name" value="{{$blog->name}}">
                    @error('name')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror
                    <br><br>
                    <div class="row">
                        <label>Choose Categories</label>&emsp;
                        <select class="js-example-basic-single form-select col-5" name="category"  aria-label="Default select example">
                            <option selected value="{{$blog->category->id}}">{{$blog->category->name}}</option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>              
                    </div>
                    @error('category')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror 
                    <br>  
                    <div class="row">
                        <label>Choose Tags</label>&emsp;&emsp;&emsp;&emsp;
                        <select class="js-example-basic-multiple form-control col-5" name="tags[]" multiple="multiple" aria-label="Default select example">
                            @foreach($tags as $tag)
                            <option
                            @foreach($blog->tags as $t)
                            @if($t->id==$tag->id) selected @endif
                            @endforeach
                            value="{{$tag->id}}">{{$tag->name}}</option>            
                            @endforeach
                        </select>              
                    </div><br>
                    @error('tags')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
            </div>
            <br>
            <br>
            <br>
            <h3 class="card-title">&emsp;Write content here</h3>
            <div class="card-body">
                    
                 <div class="formgroup">
                    <textarea class="form-control" name="content" >{{$blog->content}}</textarea>
                    @error('content')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror
                    <br>
                    <img style="width:20%;height:20%;" src="{{asset('Image/'.$blog->image)}}" alt="Add Image">
                    <input type="file" name="image">
                    <br>
                    <br>
                    @if($blog->image)
                    <a class="btn btn-outline-danger" href="{{route('delete.image',$blog->image)}}">delete image</a>
                    <br>
                    @endif
                    @error('image')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror
                    <br>
                    <button class="btn btn-success col-1" type="submit">Update</button>
                    <a class="btn btn-outline-dark" href="/newblog/blogs" >Cancel</a>
                </div>
            </div>  
        </form>
    </div>
</div>
@endsection