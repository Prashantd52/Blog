@extends('layouts.app')
@section('content')
@php
$perPage=$blogs->perPage();
$currentPage=$blogs->currentPage()-1;
$index=$perPage*$currentPage+1;
@endphp
<div class="container">
    <div class="card">
        <br>
        <div class="row">
            <h2 class="card-title col-8 pt-2">&emsp;Your Blogs
            @if(Auth::user())
                <a href="/newblog/new">+</a>
            @endif
            </h2>
             &emsp;&emsp;&emsp;
            <form class=" pt-1" action="" method="get">
                <input type="text" placeholder="search Blog name" name="searchBN" value={{$srchBN}}>&nbsp;
                <button type="submit" class="btn btn-outline-info">Go</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered" >
            <tr>
            <th >Sr.no.</th>
            <th > Name</th>
            <th >Category</th>
            <th> Tags</th>
            <th style="text-align:center;">Options</th>
            </tr>
            @foreach($blogs as $blog)
            <tr>
            <td >{{$index++}}</td>
            <td >{{$blog->name}}</td>
            <td >@if($blog->category){{$blog->category->name}}@endif</td>
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
    <a href="{{route('deleted.blog')}}">Soft deleted blogs</a>
</div>
@endsection