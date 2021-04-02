@extends('layouts.app')
@section('content')
@php
$index=1;
@endphp
<div class="container">
    <div class="card">
        <br>
        <div class="row">
            <h2 class="card-title col-10 pt-2">&emsp;Your Blogs</h2>
            @if(Auth::user())
            <a  class="btn btn-info col-1 pt-3" href="/newblog/new">Create</a>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered" >
            <tr>
            <th >Sr.no.</th>
            <th > Name</th>
            <th >Category</th>
            <th> Tags</th>
            <th style="text-align: center;">Options</th>
            </tr>
            @foreach($blogs as $blog)
            <tr>
            <td >{{$index++}}</td>
            <td >{{$blog->name}}</td>
            <td >{{$blog->category->name}}</td>
            <td>
                @foreach($blog->tags as $tag)
                <div class="badge badge-primary">{{$tag->name}}</div>
                @endforeach
            </td>
            <td >
            
                <div class="row d-flex justify-content-center" >
                    
                        <a class="btn btn-outline-primary " href="{{route('show.blog',$blog->id)}}">Open</a>&emsp;
                        @if(Auth::user())
                        <a class="btn btn-outline-info " href="{{route('e.blog',$blog->id)}}">Edit</a>&emsp;         
                        <form action="{{route('d.blog',$blog->id)}}" method="post">
                            @csrf()
                            @method('delete')
                            <button class='btn btn-danger ' type="submit">Delete</button>
                        </form>
                        @endif
                </div>
            
            </td>
            </tr>
            @endforeach
            </table>
        </div>
    </div>
    {{ $blogs->links() }}
</div>
@endsection