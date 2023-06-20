<?php

namespace App\Http\Controllers;

use App\Models\RumbleVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RumbleVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = DB::table('rumble_video')->paginate(25);

        return view('rumble-video.index', compact('videos'));
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
        $validator = Validator::make($request->all(), [
            'url' => [
                'required',
                'max:255',
                'active_url',
                'starts_with:https://rumble.com/c/,https://www.rumble.com/c/'
            ]
        ]);

        if ($validator->fails()) 
        {
            return redirect()
                    ->back()
                    ->withErrors($validator, 'addRumbleChannelVideos');
        }

        $url = $request->all()['url'];
        $response = addRumbleVideosToDatabase($url);

        if (!empty($response['error']))
        {
            return redirect()
                    ->back()
                    ->with('addRumbleChannelVideosApiError', $response['error']);
        }

        $countVideosAddedToDatabase = $response['countVideosAddedToDatabase'];

        if (0 === $countVideosAddedToDatabase)
        {
            return redirect()
                ->back()
                ->with('addRumbleChannelVideosApiError', "Error: Could not find any new videos to add to database.");
        }

        return redirect()->back()->with('addRumbleChannelVideosStatus', "Added $countVideosAddedToDatabase new videos to database!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $video = DB::table('rumble_video')->find($id);

        if (empty($video))
        {
            abort(404);
        }

        $videoTitle = $video->title;
        
        return view('rumble-video.show', compact('videoTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RumbleVideo $rumbleVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RumbleVideo $rumbleVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RumbleVideo $rumbleVideo)
    {
        //
    }
}
