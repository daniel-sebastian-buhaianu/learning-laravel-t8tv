@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Video Categories</h1>
    <div class="list-group">
        @foreach($categories as $category)
            <a href="/video-category/{{ convertToSlugFormat($category->name) }}" class="list-group-item list-group-item-action">{{ $category->name }}</a>
        @endforeach
    </div>
</div>
@endsection
