@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
    
        <h1 class="card-title text-center pt-4">{{$blog->name}}</h1>
        <p class="text-center">"{{$blog->category->name}}"</p>
        <hr style="height:2px;background-color:black;" >
        <div class="card-body">
            <p class="text-primary">
            @foreach($blog->tags as $tag)
                #{{$tag->name}}
        @endforeach</p>
            <p>
                {{$blog->content}}
            </p>
            
            <div class=" d-grid-2 col-2 mx-auto ">
                @if(Auth::user())
                <a class="btn btn-outline-dark" href="{{route('e.blog',$blog->id)}}">Edit</a>
                @endif
                <a class="btn btn-outline-danger  " href="/newblog/blogs">close</a>
            </div>
            
        </div>
    </div>
</div>
@endsection