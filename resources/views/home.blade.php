@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <p>Want to see your Blogs Please click on Blogs Tab</p>
                    <p>to Create new Blog&nbsp;<a href="{{route('n.blog')}}">Click Me</a>.</p>
                    </div>
                    <br>
                    You are logged in!
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
