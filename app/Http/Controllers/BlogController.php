<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Tag;
use Session;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs=Blog::paginate(5);
        return view('NewBlog.blogs')->withBlogs($blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('newblog.new')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:blogs,name',
            'category'=>'required',
            'tags'=>'required',
            'content'=>'required'
        ]);
        $blog=new Blog;
       
        $blog->name=$request->name;
        $blog->category_id=$request->category;
        $blog->content=$request->content;
        $blog->save();
        $blog->tags()->sync($request->tags);
        session()->flash('success','Blog is created successfully');
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog=Blog::find($id);
        return view('NewBlog.show')->withBlog($blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog=Blog::find($id);
        $categories=Category::all();
        $tags=Tag::all();
        return view('NewBlog.edit',compact('blog','tags','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|unique:blogs,name,'.$id,
            'category'=>'required',
            'tags'=>'required',
            'content'=>'required'
        ]);
        $blog=Blog::find($id);
        $blog->name=$request->name;
        $blog->category_id=$request->category;
        $blog->content=$request->content;
        $blog->save();
        $blog->tags()->sync($request->tags);
        session()->flash('warning','Blog is updated successfully');
        return redirect('newblog/blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog=Blog::find($id);
        $blog->delete();
        session()->flash('danger','Blog is deleted successfully');
        return redirect()->back();
    }
}
