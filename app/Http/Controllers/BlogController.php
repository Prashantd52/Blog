<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Tag;
use Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Photo;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $srchBN=($request->searchBN)?$request->searchBN:'';
        $blogs=Blog::search('name',$srchBN)->paginate(5);
        return view('NewBlog.blogs')->withBlogs($blogs)->withSrchBN($srchBN);
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
        if($request->image)
        {
            $extension=$request->file('image')->getClientOriginalExtension();
            if($extension!='png' || $extension!='jpg' || $extension!='jpeg')
            {
                session()->flash('danger', 'uploaded file is not an image! TRY AGAIN');
                return redirect()->back();
            }
            $image_name=$this->uploadImage($request->file('image'));
            $blog->image=$image_name;
        }
        $blog->save();
        $blog->tags()->sync($request->tags);
        session()->flash('success','Blog is created successfully');
        return redirect('newblog/blogs');
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
        if($request->image)
        {
            $extension=$request->file('image')->getClientOriginalExtension();
            if($extension!='png' || $extension!='jpg' || $extension!='jpeg')
            {
                session()->flash('danger', 'uploaded file is not an image! TRY AGAIN');
                return redirect()->back();
            }
            if($blog->image)
            {
                $delete=$this->delete_image($blog->image);
            }
            $image_name=$this->uploadImage($request->file('image'));
            $blog->image=$image_name;
        }
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
        $blog=Blog::withTrashed()->find($id);
        if($blog->deleted_at)
        {
            $blog->forcedelete();
            session()->flash('danger','Blog is Permanent deleted successfully');
        }
        else
        {
            $blog->delete();
            session()->flash('warning','Blog is Soft deleted !');
        }
        return redirect()->back();
    }

    public function deleted()
    {
        $blogs=Blog::orderBy('name','ASC')->onlyTrashed()->paginate(5);
        return view('NewBlog.deleted_blogs')
        ->withBlogs($blogs);
    }

    public function restored($id)
    {
        
        $blogs=Blog::onlyTrashed()->find($id);
        $blogs->restore();
        session()->flash('success','The Blog is restored successfully');
        return redirect()->back();
    }

    public function uploadImage($image)
    {
        $random_name=time();
        $extension=$image->getClientOriginalExtension();
        $file_name=$random_name.'.'.$extension;
        Photo::make($image)->save(public_path('Image/'. $file_name));
        return $file_name;
    }

    private function delete_image($image)
    {
        $filename = public_path('Image/' . $image);
        unlink($filename);
    }
}
