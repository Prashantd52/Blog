<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $srchTN=($request->searchTN)?$request->searchTN:'';
        $tags=Tag::search('name',$srchTN)->paginate(35);
        
        return view('tag.tag_list')->withTags($tags)->withSrchTN($srchTN);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag=new Tag;
        $tag->name=$request->name;
        $tag->save();
        return redirect('/tag/tag_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tag=Tag::where('slug',$slug)->first();
        return view('tag.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $tag=Tag::where('slug',$slug)->first();
        $str=strtolower($request->name);
        $slug = preg_replace('/a/', '-', $str);
        $random = Str::random(5);
        $tag->slug=$slug.$random;
        $tag->name=$request->name;
        $tag->save();
        return redirect('/tag/tag_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tag=Tag::withTrashed()->where('slug',$slug)->first();
        if($tag->deleted_at)
        {
            $tag->forcedelete();
            session()->flash('danger','tag permanent deleted !');
        }
        else
        {
            $tag->delete();
            session()->flash('warning','tag soft deleted !');
        }
        return redirect()->back();
    }

    public function deleted()
    {
        $tags=Tag::orderBy('name','ASC')->onlyTrashed()->paginate(5);
        return view('Tag.deleted_tags')
        ->withTags($tags);
    }

    public function restored($slug)
    {
        
        $tags=Tag::onlyTrashed()->where('slug',$slug)->first();
        $tags->restore();
        session()->flash('success','The tag is restored successfully');
        return redirect()->back();
    }
}
