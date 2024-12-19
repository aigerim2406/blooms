@extends('layouts.app')

@section('title', 'INDEX PAGE')

@section('content')
    <style>
        .text-soft-pink {
            color: #312e2f; /* Жұмсақ қызғылт */
        }

        .btn-soft-pink {
            background-color: #FF6F91;
            color: white;
            border: none;
        }

        .btn-soft-pink:hover {
            background-color: #FF5678;
            color: white;
        }

        .btn-outline-soft-pink {
            border-color: #FF6F91;
            color: #FF6F91;
        }

        .btn-outline-soft-pink:hover {
            background-color: #FF6F91;
            color: white;
        }

        .soft-divider {
            border: none;
            height: 1px;
            background-color: #FF6F91;
            opacity: 0.3;
        }

        .card {
            background-color: #fff5f8; /* Нәзік қызғылт фон */
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .alert-light {
            background-color: #fff5f8;
            color: #FF6F91;
        }

    </style>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="heading_container heading_center mb-4">
                    <center>
                        <h2 class="text-soft-pink">
                            {{ __('messages.Welcome to our gift shop blooms') }}
                        </h2>
                    </center>
                </div>

                <hr class="soft-divider">

                @if($posts->count() > 0)
                    <div class="row mt-4 g-4">
                        @foreach($posts as $post)
                            <div class="col-sm-6 col-lg-4">
                                <div class="card shadow-sm border-0">
                                    <img class="card-img-top rounded-top" src="{{ asset($post->img) }}" style="width: 100%; height: 200px; object-fit: cover;" alt="{{ $post->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted">{{ $post->title }}</h5>
                                        <p class="text-muted small">{{ __('messages.Author') }}: {{ $post->user->name }}</p>
                                        <p class="card-text text-soft-pink font-weight-bold">{{ $post->price }} ₸</p>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-soft-pink">
                                                {{ __('messages.Read More') }}
                                            </a>
                                            @can('delete', $post)
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="mb-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger" type="submit">
                                                        {{ __('messages.Delete') }}
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-light text-center mt-4 shadow-sm border">
                        {{ __('messages.No posts found.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
