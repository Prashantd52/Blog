<div class="text-center">
    <form action="{{route('store.comment')}}"method="post">
    @csrf()
    <input hidden value="{{$blogid}}" name="blogid">
    <textarea class="col-10" rows="3" name="comment" placeholder="Add new comment here" required ></textarea>
    <br>
    <button type="submit" class="btn btn-outline-success col-auto" >post</button>
    <a href="/newblog/comment/cancel/{{$blogid}}" class="btn btn-outline-dark">cancel</a>
    </form>

</div>
