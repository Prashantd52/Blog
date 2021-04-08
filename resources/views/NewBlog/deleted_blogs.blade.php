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
            <h2 class="card-title col-10 pt-2">&emsp;Your Blogs</h2>
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
            <td >@if($blog->category){{$blog->category->name}}@endif</td>
            <td>
                @foreach($blog->tags as $tag)
                <div class="badge badge-primary">{{$tag->name}}</div>
                @endforeach
            </td>
            <td >
            
                <div class="row d-flex justify-content-center" >
                    
                        <a class="btn btn-outline-info " href="{{route('restore.blog',$blog->id)}}">Restore</a>&emsp;         
                        <form action="{{route('d.blog',$blog->id)}}" method="post">
                            @csrf()
                            @method('delete')
                            <button class='btn btn-danger ' type="submit">Delete</button>
                        </form>   
                </div>
            
            </td>
            </tr>
            @endforeach
            </table>
        </div>
    </div>
    {{ $blogs->links() }}<br>
    <div class="text-center">
        <a class="btn btn-outline-primary" href="{{route('list.blog')}} ">Back</a>
    </div>
</div>
@endsection