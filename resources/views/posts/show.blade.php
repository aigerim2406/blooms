@extends('layouts.app')

@section('title', 'shoow')

@section('content')
    <style>
        .img-fluid {
            width: 450px;
            height: 480px;
            object-fit: cover;
        }
        /* Нәзік шрифт пен түсті стиль */
        h4.display-5 {
            font-family: 'Playfair Display', serif; /* Элегантты шрифт */
            font-size: 2rem; /* Өлшем */
            color: #8b5e83; /* Нәзік роза түсі */
            text-transform: capitalize;
            font-weight: 400; /* Жеңіл салмақ */
        }

        h4.fw-bold {
            font-family: 'Roboto', sans-serif; /* Заманауи, бірақ нәзік */
            color: #4a4a4a; /* Тыныш түс */
            font-weight: 600;
        }

        .star-rating label {
            font-size: 1.5rem;
            color: #f9d71c; /* Сары түс */
        }

        button, .form-control {
            border-radius: 8px; /* Шеттерді жұмсарту */
            font-size: 1rem; /* Текст өлшемі */
        }

        /* Комментарийлер мен басқа элементтер */
        .card-body {
            font-family: 'Nunito', sans-serif;
            color: #6c757d; /* Ашық сұр түсті */
        }

        .card-body p {
            font-size: 1rem;
            line-height: 1.5;
        }

        input, textarea {
            font-family: 'Nunito', sans-serif;
            background-color: #f7f7f7; /* Ашық түс */
        }

        textarea {
            resize: vertical;
        }

        .btn-outline-primary {
            border-color: #8b5e83; /* Нәзік түстер */
            color: #8b5e83;
        }

        .btn-outline-secondary {
            border-color: #f9d71c;
            color: #f9d71c;
        }

        .btn-outline-success {
            border-color: #28a745;
            color: #28a745;
        }

        /* Өзгертулер */
        input[type="number"] {
            width: 120px;
            text-align: center;
        }

    </style>
    <div class="container d-flex flex-wrap g-5">
        <div class="col-md-6">
            <img class="img-fluid rounded shadow" src="{{ asset($post->img) }}"
                 alt="{{ $post->{'title_' . app()->getLocale()} }}" style="max-height: 550px; object-fit: cover;">
        </div>
        <div class="col-md-6">
            <h4 class="display-5">{{ $post->title }}</h4>
            <h4 class="fw-bold">
                <span class="text-success">{{ $post->price }} ₸</span>
            </h4>
            <p class="mt-3">{{ $post->content }}</p>
            @can('update', $post)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-primary">
                    {{ __('messages.Edit') }}
                </a>
            @endcan
            <br><br>

            @auth
                <div class="form-group mt-4">
                    <form action="{{ route('posts.rate', $post->id) }}" method="post">
                        @csrf
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" {{ $myRating == 5 ? 'checked' : '' }} />
                            <label for="star5" title="5 stars">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="4" {{ $myRating == 4 ? 'checked' : '' }} />
                            <label for="star4" title="4 stars">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3" {{ $myRating == 3 ? 'checked' : '' }} />
                            <label for="star3" title="3 stars">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="2" {{ $myRating == 2 ? 'checked' : '' }} />
                            <label for="star2" title="2 stars">&#9733;</label>
                            <input type="radio" id="star1" name="rating" value="1" {{ $myRating == 1 ? 'checked' : '' }} />
                            <label for="star1" title="1 star">&#9733;</label>
                        </div>
                        <button class="btn btn-outline-secondary mt-2" type="submit">Rate</button>
                    </form>
                    @if($avgRating > 0)
                        <h5 class="mt-2">Rating: <span class="text-warning">{{ $avgRating }}</span></h5>
                    @endif
                </div>

                <hr>

                <div class="input-group quantity-selector">
                    <form action="{{ route('cart.puttocart', $post->id) }}" method="POST" class="mt-3">
                        @csrf
                        <input type="number" value="1" class="form-control" name="quantity" min="1" max="5" placeholder="Количество">
                        <button class="btn btn-outline-success" type="submit">{{ __('messages.To Cart') }}</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>


    <hr>

    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border" style="background: linear-gradient(to bottom, #fdf6f6, #ffecec);">
                <div class="card-body">
                    <h5 class="card-title">{{ __('messages.Add a note') }}</h5>
                    <form action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <textarea class="form-control" name="content" rows="4"
                                  placeholder="{{ __('messages.What do you think') }}?" required></textarea>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button class="btn btn-outline-success mt-3" type="submit">{{ __('messages.Save') }}</button>
                    </form>

                    <div class="mt-4">
                        @foreach($post->comments as $comment)
                            <div class="card mb-2" style="background: linear-gradient(to bottom, #ffffff, #f9f9f9);">
                                <div class="card-body">
                                    <p>{{ $comment->content }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Auth::user()->image }}" alt="avatar" width="30" height="30"
                                                 class="rounded-circle me-2">
                                            <p class="small mb-0 text-muted">{{ $comment->created_at }}</p>
                                        </div>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit">
                                                {{ __('messages.Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
