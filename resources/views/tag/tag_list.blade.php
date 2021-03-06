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
        <h2 class="card-title col-8"> &emsp;Tags available
        @permission('tag-create')
        <a href='/tag/create' >+</a>
        @endpermission
        </h2>
        &emsp;&emsp;&emsp;
       <form class=" pt-1" action="" method="get">
            <input type="text" placeholder="search Tag" name="searchTN" value={{$srchTN}}>&nbsp;
            <button type="submit" class="btn btn-outline-info">Go</button>
        </form>
    </div>
        <div class="card-body ">
        <table class="table table-striped" >
        <tr>
        <th  style="width:20%">Sr.no.</th>
        <th > Name</th>
        <th>Blogs</th>
        @permission('tag-update')
        <th style="text-align: center;">Options</th>
        @endpermission
        </tr>
        @foreach($tags as $tag)
        <tr>
        <td style="width:20%" >{{$index++}}</td>
        <td >{{$tag->name}}</td>
        <td> 
        @foreach($tag->blogs as $blog)
           <a href="{{route('show.blog',$blog->id)}}" class="badge badge-success">{{$blog->name}}</a>
        @endforeach
        @permission('tag-update')
        <td >
        <div class="row d-flex justify-content-center">
        <a class="btn btn-outline-info " href="/tag/edit/{{$tag->slug}}">edit</a>&emsp;
        <form action="/tag/destroy/{{$tag->slug}}" method="post">
        @csrf()
        @method('delete')
        <button class='btn btn-danger ' type="submit">delete</button>
        </form>
        </div>
        </td>
        @endpermission
        </tr>
        @endforeach
        
        </table>
        </div>
    </div>
    {{ $tags->links() }}
    <a href="{{route('tag.deleted')}}">Soft deleted tags</a>
</div>
    
@endsection