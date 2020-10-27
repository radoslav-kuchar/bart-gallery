<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadRequest $request)
    {
       $gallery = Gallery::findOrFail($request->gallery_id);

        foreach($request->images as $image){
            $filename = $filenameFirst = $image->getClientOriginalName();
            $pathInfo = pathinfo($filename);
            $isImage = Image::where([['gallery_id', '=' ,$gallery->id], ['filename', '=' , $filename]])->exists();
            $i = 0;
            while($isImage == true){
                $i += 1;
                $filename = $pathInfo['filename'] . "({$i})." . $pathInfo['extension'];
                $isImage = Image::where([['gallery_id', '=' ,$gallery->id], ['filename', '=' ,$filename]])->exists();
            }
            Image::create([
                'gallery_id' => $request->gallery_id,
                'filename' => $filename,
            ]);
            Storage::putFileAs('/public/'.$gallery->slug, $image, $filename);
        }
        return redirect('/gallery/'.$gallery->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show($w, $h, $slug, $filename)
    {
        $galleryCheck = Gallery::where('slug', $slug)->firstOrFail();
        $filenameCheck = Image::where('filename', $filename)->firstOrFail();

        if($w == 0){
            $size = getimagesize("storage/{$slug}/{$filename}");
            $pomer = $h/$size[1];
            $w = $pomer*$size[0];
        }
        if($h == 0){
            $size = getimagesize("storage/{$slug}/{$filename}");
            $pomer = $w/$size[0];
            $h = $pomer*$size[1];
        }
        if($w == 0 && $h == 0){
            $size = getimagesize("storage/{$slug}/{$filename}");
            $w = $size[0];
            $h = $size[1];
        }

        return view('image.show', compact('w', 'h', 'slug', 'filename'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find( $id);
        $gallery = Gallery::where('id', $image->gallery_id)->firstOrFail();

        Storage::delete("/public/{$gallery->slug}/{$image->filename}");

        DB::delete('delete from images where id = ?',[$id]);

        return redirect('/gallery/'.$gallery->slug);
    }
}
