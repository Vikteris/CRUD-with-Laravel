@extends('layouts.app')
@section('content')

    {{-- Database error/success display logic --}}
    @if (session('status_success'))
    <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
    <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif

    {{-- Validation error, for invalid incoming data, display logic --}}
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red">{{ $error }}</p>
            @endforeach
        </div>
    @endif


    @foreach ($posts as $post)
        <h1>{{ $post['title'] }}</h1>
        <p>{{ $post['text'] }}</p>
        {{-- Komentarų eilučiu po postu įdėjimas --}}
        <p style="font-size: 10px">Comment count: {{ count($post->comments) }} 
        | <a href="{{ route('posts.show', $post['id']) }}">View post details and comment on it</a>
        | Author: {{ $post['user']['name'] }} , {{ $post['user']['email'] }}</p>
        
        {{-- Hide buttons if the user is not logged in  --}}
        @if (auth()->check()) {{-- <--- Pasako ar vartotojas yra prisijungęs!!!--}}
                <div style="overflow: auto">
                    <form style='float: left;' action="{{ route('posts.show', $post['id']) }}" method="GET">
                        <input type="submit" value="UPDATE">
                    </form>
                    <form style='float: left;' action="{{ route('posts.destroy', $post['id']) }}" method="POST">
                        @method('DELETE') @csrf
                        <input type="submit" value="DELETE">
                    </form>
                </div>
            @endif

            
        {{-- DELETE MYGTUKAS
        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST">
            @method('DELETE') @csrf
            <input type="submit" value="DELETE">
        </form>
        
        UPDATE MYGTUKAS KURIS VES I REDAGAVIMO PAGE
        <form action="{{ route('posts.show', $post['id']) }}" method="GET">
            <input type="submit" value="UPDATE">
        </form> --}}
    @endforeach

    {{-- @foreach ($posts as $post)
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            <b>{{ $post->title }}</b> //naudojama arrow funkcija
        
        </div>
        <div class="card-body">
            <p>{{ $post->text }}</p>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @method('DELETE') @csrf
                <input type="submit" value="DELETE">
            </form>
            <form action="{{ route('posts.show', $post->id) }}" method="GET">
                <input type="submit" value="UPDATE">
            </form>                 
        </div>
    </div>
    @endforeach --}}


    {{-- Sukurimo naujo posto lentelė --}}
    <hr>
    <form method="POST" action="/posts">
        @csrf
        <label for="title">Post title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="text">Post text:</label><br>
        <input type="text" id="text" name="text"><br><br>
        <input type="submit" value="Submit">
    </form>
    

@endsection
