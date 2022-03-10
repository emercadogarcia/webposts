@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title}} </h5>
                    <p class="card-text">
                        {{ $post->body}}
                        <br>
                        {{ $post->slug }} <br>
                        {{ $post->image }} <br>
                        {{ $post->iframe }} <br>

                        <a href="{{ route('post', $post) }}">Leer mas</a>
                    </p>
                    <p class="text-muted mb-0">
                        <em>
                            &ndash; {{ $post->user->name }}
                        </em>
                        {{ $post->created_at->format('d M Y')}}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
