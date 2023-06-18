<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tate TV</title>
    </head>
    <body>
        <header>
        @if (Route::has('login'))
            <nav>
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
            </nav>
        @endif
        </header>
        <main>
            <h1 style="text-align: center;">Welcome to Tate TV!</h1>
        </main>
    </body>
</html>
