<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Blog;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    
    public function create($id)
    {
        $blogid=$id;
        return view('comment.newcomment')->withBlogid($blogid);
    }

    
    public function store(Request $request)
    {
        //dd($request);
        $savecomment=new Comment;
        $savecomment->blog_id=$request->blogid;
        $savecomment->comment=$request->comment;
        $savecomment->save();
        $blog=Blog::where('id',$request->blogid)->first();
        
        return redirect()->route('show.blog',$blog->slug);
    }

    
    public function show(Comment $comment)
    {
        //
    }

    
    public function edit($id)
    {
        $comment=Comment::get()->find($id);
        //dd($comment);
        return view('comment.editcomment')->withComment($comment);
    }

    
    public function update(Request $request,$id)
    {
        //dd($id);
        $comment=Comment::get()->find($id);
        $comment->comment=$request->comment;
        $comment->save();
        $blog=Blog::where('id',$request->blogid)->first();
        
        return redirect()->route('show.blog',$blog->slug);
    }

    
    public function destroy($id)
    {
        $comment=Comment::get()->find($id);
        //dd($comment);
        $comment->delete();
        return redirect()->back();
    }

    public function cancel($blogid)
    {
        $blog=Blog::where('id',$blogid)->first();
        return redirect(route('show.blog',$blog->slug));
    }
}
