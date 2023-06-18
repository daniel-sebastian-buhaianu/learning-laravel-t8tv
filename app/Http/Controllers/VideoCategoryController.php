<?php

namespace App\Http\Controllers;

use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('video_category')->get();

        return view('video-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:video_category|max:255|min:4|string',
        ]);

        $videoCategoryName = $request->all()['name']; 

        VideoCategory::create([
            'name' => $videoCategoryName,
        ]);

        return redirect()->back()->with('message', "Video category '$videoCategoryName' has been successfully created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoCategory $videoCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoCategory $videoCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoCategory $videoCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoCategory $videoCategory)
    {
        //
    }
}
