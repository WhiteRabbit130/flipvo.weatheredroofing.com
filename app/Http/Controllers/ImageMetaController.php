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
        return response()->view('admin.index', [
            'images' => ImageMeta::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('admin.form');
    }


    /**
     * Upload a new image to tmp dir.
     */
    public function tmpUpload(Request $request)
    {
        // dd($request->all());

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
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // put image in the public storage
            $filePath = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'));
            $validated['featured_image'] = $filePath;
        }

        // insert only requests that already validated in the StoreRequest
        $create = ImageMeta::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Image created successfully!');
            return redirect()->route('admin.index');
        }

        return abort(500);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->view('admin.show', [
            'image' => ImageMeta::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return response()->view('admin.form', [
            'image' => ImageMetha::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, String $id)
    {
        $post = ImageMeta::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // delete image
            Storage::disk('public')->delete($post->featured_image);

            $filePath = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'), 'public');
            $validated['featured_image'] = $filePath;
        }

        $update = $post->update($validated);

        if($update) {
            session()->flash('notif.success', 'Image updated successfully!');
            return redirect()->route('admin.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = ImageMeta::findOrFail($id);

        Storage::disk('public')->delete($post->featured_image);

        $delete = $post->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Image deleted successfully!');
            return redirect()->route('admin.index');
        }

        return abort(500);
    }
}
