@extends('layouts.app')
@section('content')
@php
$index=1;
@endphp
<div class="container">
    <div class="card">
    <br>
    <div class="row">
        <h2 class="card-title col-10"> &emsp;Categories available</h2>
        <a class="btn btn-primary col-1 pt-2"  href='/category/create'>Create</a>
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
        <td >{{$category->name}}</td>
        <td style="width:40%">{{$category->description}}</td>
        <td>
        @foreach($category->blogs as $blog)
            <a href="{{route('show.blog',$blog->id)}}" class="badge badge-info">{{$blog->name}}</a>
        @endforeach
        </td>
        <td >
        <div class="row d-flex justify-content-center">
        <a class="btn btn-outline-info" href="/category/edit/{{$category->id}}">edit</a>&emsp;
            <form action="/category/destroy/{{$category->id}}" method="post">
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
</div>
    
@endsection