@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="card" >
        <h1 class="card-title text-right pt-2">{{$blog->name}}&nbsp;
        <a  class="btn btn-light col-auto" href="/newblog/blogs"><b>x</b></a></h1>
        <p class="text-right pr-5">category: "{{$blog->category->name}}"&emsp;</p>
        <hr style="height:2px;background-color:black;" >
        <div class="row pb-2">
        <div class="container col-md-8">
        <div class="card-body border border-dark rounded">
            <p class="text-primary">
            @foreach($blog->tags as $tag)
                #{{$tag->name}}
            @endforeach</p>
            <img style="width:20%;height:20%" src="{{asset('Image/'.$blog->image)}}" alt="{{$blog->name}}">
            <p>
                {{$blog->content}}
            </p>
            
            <div class="row  pl-2">
                @if(Auth::user())
                <a class="btn btn-outline-dark" href="{{route('e.blog',$blog->slug)}}">Edit</a>
                @endif
                &emsp;
                <a class="btn btn-outline-danger  " href="/newblog/blogs">close</a>
            </div>
            
        </div>
        </div>
        
        <div class="container col-3 bg-warning border border-dark" >
            <h6 class="pt-2"><i>Comments :</i></h6>
            <a class="btn btn-success" href="#" onclick="addcomment({{$blog->id}})">add comemnt</a>
            <br>
            <br>
            <div id="data">
            <script>
                function addcomment(id)
                {
                $.ajax({
                    type:'GET',
                    url:'/newblog/addcomment/'+id,
                    success:function(data) {
                    $("#data").html(data);
                    }
                });
                }
            </script>
            </div>
            <br>
            @foreach($blog->comments as $cmnt)
            <div class="row form-group pl-2" >
                <textarea rows="2" readonly>{{$cmnt->comment}}</textarea>
            &nbsp;
            <div class="text pt-2">
            <h4><a class="badge badge-primary col-auto" href="#" onclick="edit({{$cmnt->id}})">edit</a>
                <script>
                    function edit(id)
                    {
                        $.ajax({
                            type:'GET',
                            url:'/newblog/comment/edit/'+id,
                            success:function(data) {
                                $("#data").html(data);
                            }
                        }); 
                        
                    }
                </script>
            <a class="badge badge-danger col-auto" href="/newblog/comment/delete/{{$cmnt->id}}" >&#128465;</h4></a>
            </div>
            </div>
            @endforeach
        </div>
        </div>
    </div>
</div>
@endsection
