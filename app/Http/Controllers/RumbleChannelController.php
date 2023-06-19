<?php

namespace App\Http\Controllers;

use App\Models\RumbleChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RumbleChannelController extends Controller
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
                'unique:rumble_channel',
                'max:255',
                'active_url',
                'starts_with:https://rumble.com/c/,https://www.rumble.com/c/'
            ]
        ]);

        if ($validator->fails()) 
        {
            return redirect()
                ->back()
                ->withErrors($validator, 'addRumbleChannel');
        }

        $url = $request->all()['url'];
        $apiUrl = "https://dsb99.app/rumble/api/v1/channel?url=$url";
        $response = json_decode(makeGetRequest($apiUrl));

        if (empty($response->data->url) || empty($response->data->id))
        {
            return redirect()
                ->back()
                ->with('addRumbleChannelApiError', $response->message);
        }

        $rumbleChannelId = $response->data->id;
        $rumbleChannelUrl = $response->data->url;
        
        $apiUrl = 'https://dsb99.app/rumble/api/v1/channel/'.$rumbleChannelId.'/about';
        $response = json_decode(makeGetRequest($apiUrl));
        $data = $response->data;

        RumbleChannel::create([
            'id' => $rumbleChannelId,
            'url' => $rumbleChannelUrl,
            'title' => $data->title,
            'joining_date' => convertRumbleJoiningDateToMysqlDateFormat($data->joining_date),
            'description' => $data->description,
            'banner' => $data->banner,
            'avatar' => $data->avatar,
            'followers_count' => convertRumbleFollowersCountToInt($data->followers_count),
            'videos_count' => convertRumbleVideosCountToInt($data->videos_count),
        ]);

        return redirect()->back()->with('addRumbleChannelStatus', "The rumble channel '$data->title' has been successfully added to the database.");
    }

    /**
     * Display the specified resource.
     */
    public function show(RumbleChannel $rumbleChannel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RumbleChannel $rumbleChannel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RumbleChannel $rumbleChannel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RumbleChannel $rumbleChannel)
    {
        //
    }
}
