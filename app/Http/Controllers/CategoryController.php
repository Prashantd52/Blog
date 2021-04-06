<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function edit($id)
    {
        
       $category=Category::find($id);
        return view('Category.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category=Category::find($id);
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
    public function destroy($id)
    {
        $category=Category::withTrashed()->find($id);
        if($category->deleted_at)
        {
            $category->forcedelete();
            session()->flash('danger','Category permanent deleted');
        }
        else
        {
            $category->delete();
            session()->flash('warning','Category Soft deleted!');
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

    public function restored($id)
    {
        $category=Category::onlyTrashed()->find($id);
        $category->restore();
        session()->flash('success','The category is restored successfully');
        return redirect()->back();
    }
}
