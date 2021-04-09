@extends('layouts.app')
@section('content')
@php
$perPage=$categories->perPage();
$currentPage=$categories->currentPage()-1;
$index=$perPage*$currentPage+1;
@endphp
<div class="container">
    <div class="card">
    <br>
    <div class="row">
        <h2 class="card-title col-8"> &emsp;Categories available
        <a href='/category/create'>+</a>
        </h2>
        &emsp;&emsp;&emsp;
       <form class=" pt-1" action="" method="get">
            <input type="text" placeholder="search category name" name="searchCN" value={{$srchCN}}>&nbsp;
            <button type="submit" class="btn btn-outline-info">Go</button>
        </form>
    </div>
        <div class="card-body">
        <table class="table table-striped " >
        <tr>
        <th >Sr.no.</th>
        <th > Name</th>
        <th >Description</th>
        <th >Blogs</th>
        <th style="text-align: center;">Options</th>
        </tr>
        @foreach($categories as $category)
        <tr>
        <td >{{$index++}}</td>
        <td style="width:10%">{{$category->name}}</td>
        <td style="width:40%">{{$category->description}}</td>
        <td>
        @foreach($category->blogs as $blog)
            <a href="{{route('show.blog',$blog->id)}}" class="badge badge-info">{{$blog->name}}</a>
        @endforeach
        </td>
        <td >
        <div class="row d-flex justify-content-center">
        <a class="btn btn-outline-info" href="/category/edit/{{$category->slug}}">edit</a>&emsp;
            <form action="/category/destroy/{{$category->slug}}" method="post">
                @csrf()
                @method('delete')
                <button class='btn btn-danger ' type="submit">delete</button>
            </form>
            </td>
        </div>
        </tr>
        @endforeach
        </table>
        </div>
    </div>
    {{ $categories->links() }}
    <a href="{{route('category.deleted')}}">Soft deleted Categories</a>
</div>
    
@endsection