<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Tag;
use Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Photo;
use Illuminate\Support\Str;

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
        $blogs=Blog::search('name',$srchBN)->orderBy('name','ASC')->paginate(5);
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
            'content'=>'required',
            'image'=>'image'
        ]);
        $blog=new Blog;
        $str=strtolower($request->name);
        $random=Str::random(5);
        $slug=preg_replace('/b/','$',$str);
        $blog->slug=$slug.$random;
        $blog->name=$request->name;
        $blog->category_id=$request->category;
        $blog->content=$request->content;
        if($request->image)
        {
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
    public function show($slug)
    {
        $blog=Blog::where('slug',$slug)->first();
        return view('NewBlog.show')->withBlog($blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $blog=Blog::where('slug',$slug)->first();
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
    public function update(Request $request,$slug)
    {
        $blog=Blog::where('slug',$slug)->first();
        $request->validate([
            'name'=>'required|unique:blogs,name,'.$blog->id,
            'category'=>'required',
            'tags'=>'required',
            'content'=>'required',
            'image'=>'image'
        ]);
        //$blog=Blog::where('slug',$slug)->first();
        $str=strtolower($request->name);
        $random=Str::random(5);
        $slug=preg_replace('/b/','$',$str);
        $blog->slug=$slug.$random;
        $blog->name=$request->name;
        $blog->category_id=$request->category;
        $blog->content=$request->content;
        if($request->image)
        {
           
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
        return redirect(route('show.blog',$blog->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $blog=Blog::withTrashed()->where('slug',$slug)->first();
        if($blog->deleted_at)
        {
            if($blog->image)
            {
                $delete=$this->delete_image($blog->image);
            }
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

    public function restored($slug)
    {
        
        $blogs=Blog::onlyTrashed()->where('slug',$slug)->first();
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

    public function delete_image_only($image)
    {
        $blog=Blog::where('image',$image)->first();
        $blog->image="";
        $blog->save();
        $filename = public_path('Image/' . $image);
        unlink($filename);
        return redirect()->back();
    }

    
}
