<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::paginate(12);

        return view('gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
        );

        $validator = Validator::make($data, [
            'name' => 'unique:galleries|required|not-regex:/\//i',
            'slug' => 'unique:galleries',
        ]);

        if ($validator->fails()) {
            return redirect('/gallery')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            Gallery::create($data);
        }
        return redirect('/gallery');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $gallery = Gallery::where('slug', $slug)->first();
        $images = Image::where('gallery_id', $gallery->id)->paginate(15);

        return view('gallery.show', compact('gallery', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        
        Storage::deleteDirectory("/public/{$gallery->slug}");

        $images = Image::where('gallery_id', $id);

        foreach($images as $image){
            DB::delete('delete from images where id = ?', [$image->id]);
        }

        DB::delete('delete from galleries where id = ?', [$id]);

        return redirect('/gallery/');
    }
}
