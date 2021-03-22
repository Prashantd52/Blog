@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <h2 class="card-title">&emsp;Tag Create Page</h2>
        <div class="card-body">
            <form action="/tag/store" method="post">
            @csrf()
            <div class="form-group">
                <label>Tag name</label>
                <input class="form-control" name="name" type="text"><br><br>
            </div>
            <button class="btn btn-success" type="submit"> Submit</button>
            <a class="btn btn-info" href='/tag/tag_list'>back</a>
            </form>
        </div>
    </div>
</div>

@endsection