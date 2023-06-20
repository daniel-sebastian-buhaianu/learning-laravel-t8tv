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

        $rumbleChannel= getRumbleChannelAboutData($url);

        if (!empty($rumbleChannel['error']))
        {
            return redirect()
                ->back()
                ->with('addRumbleChannelApiError', $rumbleChannel['error']);
        }

        $queryResult = addRumbleChannelToDatabase($rumbleChannel['data']);

        if (false === $queryResult)
        {
            return redirect()
                ->back()
                ->with('addRumbleChannelApiError', 'Something went wrong.');
        }

        return redirect()->back()->with('addRumbleChannelStatus', "Success!");
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
