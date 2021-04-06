<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

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
        $tags=Tag::search('name',$srchTN)->paginate(5);
        
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
    public function edit($id)
    {
        $tag=Tag::find($id);
        return view('tag.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag=Tag::find($id);
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
    public function destroy($id)
    {
        $tag=Tag::withTrashed()->find($id);
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

    public function restored($id)
    {
        
        $tags=Tag::onlyTrashed()->find($id);
        $tags->restore();
        session()->flash('success','The tag is restored successfully');
        return redirect()->back();
    }
}
