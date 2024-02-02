<?php

namespace App\Http\Controllers;

use App\Models\ImageMeta;
use Illuminate\Http\Request;

class ImageMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Upload a new image to tmp dir.
     */
    public function tmpUpload(Request $request)
    {
        dd($request->all());

        // todo - need to crop images, etc...
        $request->validate([
            'image' => 'required|image|file|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        // Create ImageMeta
        $meta = ImageMeta::create([
            'filename' => $request->file('image')->getClientOriginalName(),
            'path' => $request->file('image')->store('tmp', 'public'),
            'url' => '',
            'imageable_id' => 0,
            'imageable_type' => 'test',
        ]);

        // todo - resize image
        // todo - upload to tmp dir



        return response()->json($meta);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ImageMeta $imageMeta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImageMeta $imageMeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageMetaRequest $request, ImageMeta $imageMeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageMeta $imageMeta)
    {
        //
    }
}
