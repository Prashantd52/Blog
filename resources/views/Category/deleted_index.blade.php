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
                <a class="btn btn-outline-dark btn-sm"href="{{route('category.restore',$category->slug)}}">restore</a>&emsp;
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
    {{ $categories->links() }}<br>
    <div class="text-center">
        <a class="btn btn-outline-primary" href="/category/categories">Back</a>
    </div>
</div>
    
@endsection