@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <h1 class="card-title text-right pt-2">{{$blog->name}}&nbsp;
        <a  class="btn btn-outline-light col-auto" href="/newblog/blogs">x</a></h1>
        <p class="text-right pr-5">category: "{{$blog->category->name}}"&emsp;</p>
        <hr style="height:2px;background-color:black;" >
        <div class="card-body">
            <p class="text-primary">
            @foreach($blog->tags as $tag)
                #{{$tag->name}}
            @endforeach</p>
            <img style="width:20%;height:20%" src="{{asset('Image/'.$blog->image)}}" alt="{{$blog->name}}">
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