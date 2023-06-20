@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rumble Channels</h1>
    <div class="list-group">
        @foreach($channels as $channel)
            <a href="/rumble-channel/{{ $channel->rumble_id }}" class="list-group-item list-group-item-action">{{ $channel->title }}</a>
        @endforeach
    </div>
</div>
@endsection
