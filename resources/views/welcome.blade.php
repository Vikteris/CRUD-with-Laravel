@extends('layouts.app')

@section('content')
{{-- <h1>Hi, {{ $var }} !</h1> --}}
{{-- {{ var_dump($person)}} --}}
{{-- @if ($var === 1)
        First section!
    @elseif ($var === 2)
        Second section!
    @endif

    @foreach($letters as $letter)
        <br>
        {{ $letter }}
    @endforeach --}}
    
    {{-- {{ $person->name . " " . $person->age }} --}}

    {{-- @if ($people)
        @foreach($people as $person)
            {{ $person->age }}
            {{ $person->name }}
            <br>
        @endforeach
    @endif --}}
        <h1>Welcome to this awsome  app</h1>
@endsection