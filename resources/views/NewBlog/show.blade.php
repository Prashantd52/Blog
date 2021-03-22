@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
    
        <h2 class="card-title pt-4">&emsp;{{$blog->name}}</h2>
        <div class="card-body">
            <p>
                {{$blog->content}}
            </p>
            
            <div class=" d-grid-2 col-2 mx-auto ">
                <a class="btn btn-outline-danger col-12 " href="/newblog/blogs">close</a>
            </div>
            
        </div>
    </div>
</div>
@endsection