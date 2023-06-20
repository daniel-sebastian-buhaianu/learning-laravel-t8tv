@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rumble Videos</h1>
    <div class="list-group">
        @foreach($videos as $video)
            <a href="/rumble-video/{{ $video->id }}" class="list-group-item list-group-item-action">{{ $video->title }}</a>
        @endforeach
    </div>
    {{ $videos->links() }}
</div>
@endsection
