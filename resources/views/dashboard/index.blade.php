@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <form class="mt-5" action="/video-category" method="post">
        @csrf
        <h4>Create Video Category</h4>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Name:<input type="text" name="name" placeholder="Video Category Name"><input type="submit" value="Create"></p>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </form>
</div>
@endsection
