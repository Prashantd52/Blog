<div class="text-center">
    <form action="{{route('update.comment',$comment)}}" method="post">
    @csrf()
    @method('put')
    <input hidden value="{{$comment->blog_id}}" name="blogid">
    <textarea class="col-10" rows="3" name="comment" placeholder="write commment here" required >{{$comment->comment}}</textarea>
    <br>
    <button type="submit" class="btn btn-outline-secondary col-auto" >update</button>
    <a href="/newblog/comment/cancel/{{$comment->blog_id}}" class="btn btn-outline-dark">cancel</a>
    </form>

</div>

