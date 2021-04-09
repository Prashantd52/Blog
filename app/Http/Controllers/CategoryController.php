<?php

namespace App\Http\Controllers;

use App\Category;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $srchCN=($request->searchCN)?$request->searchCN:'';
        $categories=Category::search('name',$srchCN)->orderBy('name','ASC')->paginate(5);

        return view('Category.categories',compact('categories','srchCN'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category=new Category;
        $str=strtolower($request->name);
        $slug = preg_replace('/\s+/', '-', $str);
        $random = Str::random(5);
        $category->slug=$slug.$random;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        return redirect('/category/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        
       $category=Category::where('slug',$slug)->first();

        return view('Category.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $category=Category::where('slug',$slug)->first();
        $str=strtolower($request->name);
        $slug = preg_replace('/\s+/', '-', $str);
        $random = Str::random(5);
        $category->slug=$slug.$random;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        return redirect('/category/categories');

       // dd($category,$request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category=Category::withTrashed()->where('slug',$slug)->first();
        $blog=Blog::where('category_id',$category->id)->first();
        
        if($category->deleted_at)
        {
            $category->forcedelete();
            session()->flash('danger','Category permanent deleted');
        }
        else
        {
            if($blog!=null)
            {
                session()->flash('warning','This category has a blog. So, It will not be deleted !');
            }
            else
            {
                $category->delete();
                session()->flash('warning','Category Soft deleted!');
        
            }
        }
        return redirect()->back();
    }

    public function deleted()
    {
        $categories=Category::orderBy('name','ASC')->onlyTrashed()->paginate();
        return view('Category.deleted_index')
        ->withCategories($categories)
        ;
    }

    public function restored($slug)
    {
        $category=Category::onlyTrashed()->where('slug',$slug)->first();
        $category->restore();
        session()->flash('success','The category is restored successfully');
        return redirect()->back();
    }
}
