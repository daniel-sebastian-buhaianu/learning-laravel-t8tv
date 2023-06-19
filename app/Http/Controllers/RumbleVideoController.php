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
        $apiUrl = "https://dsb99.app/rumble/api/v1/channel?url=$url";
        $response = json_decode(makeGetRequest($apiUrl));

        if (empty($response->data->url) || empty($response->data->id))
        {
            return redirect()
                ->back()
                ->with('addRumbleChannelVideosApiError', $response->message);
        }

        $rumbleChannelId = $response->data->id;
        $rumbleChannelUrl = $response->data->url;
        
        $apiUrl = 'https://dsb99.app/rumble/api/v1/channel/'.$rumbleChannelId.'/videos';
        $response = json_decode(makeGetRequest($apiUrl));
        $videos = $response->data->videos;

        $rumbleChannelIdInTable = getRumbleChannelIdInTable($rumbleChannelId);

        if (empty($rumbleChannelIdInTable))
        {
            return redirect()
                ->back()
                ->with('addRumbleChannelVideosApiError', 'Error: The videos belong to a rumble channel which is not in the database. Please add the rumble channel to the database first.');
        }

        foreach($videos as $video)
        {
            $dataToValidate = [
                'title' => $video->title,
                'url' => $video->url
            ];

            $validator = Validator::make($dataToValidate, [
                'title' => [
                    'string',
                    'max:255',
                    'unique:rumble_video'
                ],
                'url' => [
                    'string',
                    'max:255',
                    'unique:rumble_video'
                ]
            ]);

            if ($validator->fails()) 
            {
                return redirect()
                    ->back()
                    ->withErrors($validator, 'addRumbleChannelVideos');
            }

            createRumbleVideo($video, $rumbleChannelIdInTable);
        }

        return redirect()->back()->with('addRumbleChannelVideosStatus', "Success!");
    }

    /**
     * Display the specified resource.
     */
    public function show(RumbleVideo $rumbleVideo)
    {
        //
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
