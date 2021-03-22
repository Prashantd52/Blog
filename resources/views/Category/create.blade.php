@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <h2 class="card-title">&emsp;Category Create Page</h2>
        <div class="card-body">
            <form action="/category/store" method="post">
            @csrf()
            <div class="form-group">
                <label>Category name</label>
                <input class="form-control" name="name" type="text" required><br><br>
            </div>
          <div class="form-group">
          <label>Description</label>
            <textarea class="form-control" name="description" required></textarea><br>
          </div>
            <button class="btn btn-success" type="submit"> Submit</button>
            <a class="btn btn-info" href='/category/categories'>back</a>
            </form>
        </div>
    </div>
</div>

@endsection