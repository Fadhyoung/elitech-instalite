{{-- resources/views/feeds.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($feeds as $feed)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset('storage/'.$feed->media_path) }}" class="card-img-top" alt="Feed Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $feed->caption }}</h5>
                            <p class="card-text">{{ $feed->user->profile->username }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
