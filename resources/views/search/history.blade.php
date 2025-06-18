@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Your Recent Searches</title>
</head>
<body>
    <h1>Your Recent Searches</h1>

    @if($history->isEmpty())
        <p>No search history found.</p>
    @else
        <ul>
            @foreach($history as $item)
                <li>
                    <strong>Query:</strong> {{ $item->query }}<br>
                    <small>At: {{ $item->created_at->format('Y-m-d H:i:s') }}</small>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/california.svg') }}" alt="CALIFORNIA" />
        </a>
    </div>
</body>
</html>
@endsection
