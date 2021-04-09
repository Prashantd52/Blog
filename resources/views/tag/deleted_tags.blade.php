@extends('layouts.app')
@php
$perPage=$tags->perPage();
$currentPage=$tags->currentPage()-1;
$index=$perPage*$currentPage+1;
@endphp
@section('content')
<div class="container">
    <div class="card">
    <br>
    <div class="row">
        <h2 class="card-title col-10"> &emsp;Tags available</h2>
    </div>
        <div class="card-body ">
        <table class="table table-striped" >
        <tr>
        <th  style="width:20%">Sr.no.</th>
        <th > Name</th>
        <th>Blogs</th>
        <th style="text-align: center;">Options</th>
        </tr>
        @foreach($tags as $tag)
        <tr>
        <td style="width:20%" >{{$index++}}</td>
        <td >{{$tag->name}}</td>
        <td> 
        @foreach($tag->blogs as $blog)
           <a href="{{route('show.blog',$blog->id)}}" class="badge badge-success">{{$blog->name}}</a>
        @endforeach
        <td >
        <div class="row d-flex justify-content-center">
        <a class="btn btn-outline-dark btn-sm" href="{{route('tag.restore',$tag->slug)}}">restore</a>&emsp;
        <form action="/tag/destroy/{{$tag->slug}}" method="post">
        @csrf()
        @method('delete')
        <button class='btn btn-danger ' type="submit">delete</button>
        </form>
        </div>
        </td>
        </tr>
        @endforeach
        
        </table>
        </div>
    </div>
    {{ $tags->links() }}<br>
    <div class="text-center">
        <a class="btn btn-outline-primary" href="/tag/tag_list ">Back</a>
    </div>
</div>
    
@endsection