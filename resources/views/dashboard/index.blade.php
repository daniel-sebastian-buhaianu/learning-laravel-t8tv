@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <form class="mt-5" action="/video-category" method="post">
        @csrf
        <h4>Create Video Category</h4>
        @if (count($errors->createVideoCategory) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->createVideoCategory->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Name:<input type="text" name="name" placeholder="Video Category Name"><input type="submit" value="Create"></p>
        @if(session()->has('createVideoCategoryStatus'))
            <div class="alert alert-success">
                {{ session()->get('createVideoCategoryStatus') }}
            </div>
        @endif
    </form>

    <form class="mt-5" action="/rumble-channel" method="post">
        @csrf
        <h4>Add Rumble Channel About Data To Database</h4>
        @if (count($errors->addRumbleChannel) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->addRumbleChannel->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('addRumbleChannelApiError'))
            <div class="alert alert-danger">
                {{ session()->get('addRumbleChannelApiError') }}
            </div>
        @endif
        <p>URL:<input type="text" name="url" placeholder="Rumble Channel URL"><input type="submit" value="Add"></p>
        @if(session()->has('addRumbleChannelStatus'))
            <div class="alert alert-success">
                {{ session()->get('addRumbleChannelStatus') }}
            </div>
        @endif
    </form>

    <form class="mt-5" action="/rumble-video" method="post">
        @csrf
        <h4>Add Rumble Channel Videos Data To Database</h4>
        @if (count($errors->addRumbleChannelVideos) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->addRumbleChannelVideos->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('addRumbleChannelVideosApiError'))
            <div class="alert alert-danger">
                {{ session()->get('addRumbleChannelVideosApiError') }}
            </div>
        @endif
        <p>URL:<input type="text" name="url" placeholder="Rumble Channel URL"><input type="submit" value="Add"></p>
        @if(session()->has('addRumbleChannelVideosStatus'))
            <div class="alert alert-success">
                {{ session()->get('addRumbleChannelVideosStatus') }}
            </div>
        @endif
    </form>
</div>
@endsection
