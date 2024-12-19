@extends('layouts.app')

@section('title', 'INDEX PAGE')

@section('content')
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
              rel="stylesheet">
    </head>

    <style>
        body {
            background: linear-gradient(to right, #FDE2E4, #ffffff);
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .pagination {
            justify-content: center;
            font-size: 0.875rem;
        }

        .pagination .page-item .page-link {
            padding: 5px 10px;
            border-radius: 25px;
        }

        .about-us-section {
            color: #333;
            font-family: 'Poppins', sans-serif;
            padding: 50px 0;
        }

        .about-us-section h2 {
            color: #d64550;
        }

        .about-us-section img {
            max-width: 550px;
            height: 600px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-section .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .fancy-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: #8b5e83;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            margin-bottom: 20px;
        }

        .fancy-heading::before,
        .fancy-heading::after {
            content: "";
            position: absolute;
            width: 50px;
            height: 2px;
            background-color: #8b5e83;
            top: 50%;
            transform: translateY(-50%);
        }

        .fancy-heading::before {
            left: -70px;
        }

        .fancy-heading::after {
            right: -70px;
        }

        .message-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .message-icon .btn {
            border-radius: 50%;
            padding: 15px;
            font-size: 1.5rem;
            background-color: rgba(129, 217, 114, 0.8);
            border: none;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: box-shadow 0.3s ease;
        }

        .message-icon .btn:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        .contact-options {
            display: none;
            position: absolute;
            bottom: 60px;
            right: 0;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 10px;
            border-radius: 8px;
            width: 200px;
        }

        .contact-options a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-options a:hover {
            background-color: #f1f1f1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .contact-options.show {
            display: block;
        }

        footer {
            background-color: #2c2a2a;
            color: white;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactButton = document.getElementById('contactButton');
            const contactOptions = document.getElementById('contactOptions');

            contactButton.addEventListener('click', function() {
                contactOptions.classList.toggle('show');
            });
        });
    </script>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <br>
                @if(auth()->check() && auth()->user()->role == "admin")
                    <a href="{{ route('posts.create') }}" class="btn btn-success">{{ __('messages.Create') }}</a>
                @endif
                <br><br>

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('img/banner3.jpg') }}" alt="Banner Image">
                        </div>
                    </div>
                </div>

                <br><br><br>
                <div class="heading_container heading_center">
                    <h2 class="fancy-heading">
                        {{ __('messages.gallery') }}
                    </h2>
                </div>

                <br><br><br>
                <div class="row gx-3 gy-3">
                    @foreach($posts as $post)
                        <div class="col-lg-3 col-md-4 col-sm-6 mt-3">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ asset($post->img) }}" alt="{{ $post->title }}"
                                     style="width: 100%; height: auto; object-fit: contain;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->price }} ₸</p>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary me-2">
                                            {{ __('messages.Read More') }}
                                        </a>
                                        @if(auth()->check() && auth()->user()->role == "admin")
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="mb-0">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger" type="submit">
                                                    {{ __('messages.Delete') }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>

    <br><br>

    <section class="about-us-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Сурет бөлімі -->
                <div class="col-md-6">
                    <img src="{{ asset('img/aboutUs.jpg') }}" alt="Blooms Flowers" class="img-fluid rounded shadow">
                </div>
                <!-- Мәтін бөлімі -->
                <div class="col-md-6 text-center">
                    <h2 class="mb-4">{{ __('messages.About') }}</h2>
                    <p>{{ __('messages.Welcome') }}<strong>blooms</strong>! 🌸</p>
                    <p>
                        <strong>blooms</strong>, {{ __('messages.at') }}
                    </p>
                    <p>
                        {{ __('messages.since') }}
                    </p>
                    <p>
                        <strong>{{ __('messages.our') }}:</strong> {{ __('messages.mission') }}
                    </p>
                    <p>
                        {{ __('messages.from') }}
                        <strong>blooms</strong> {{ __('messages.is here') }}
                    </p>
                    <p>
                        {{ __('messages.thanks') }} <strong>blooms</strong> {{ __('messages.to be') }}
                    </p>
                </div>
            </div>
        </div>
    </section>


    <br><br>

    <section class="contact-section">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4">
                    <div class="card py-3 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h5 class="text-uppercase m-0">Address</h5>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">NarXoz university...</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card py-3 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-phone-alt text-primary mb-2"></i>
                            <h5 class="text-uppercase m-0">Phone</h5>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">+7 (777) 754-88-32</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card py-3 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h5 class="text-uppercase m-0">Email</h5>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">aigerim.gubaidullina@narxoz.kz</div>
                            <div class="small text-black-50">aruzhan.kadyrkul@narxoz.kz</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><hr><br>

    <footer>
        <div class="container">
            <p class="text-center py-3 mb-0">© 2024 <strong>blooms</strong> | university Narxoz</p>
        </div>
    </footer>

    <div class="message-icon">
        <button id="contactButton" class="btn btn-primary">
            <i class="fas fa-comment-dots"></i>
        </button>

        <!-- Контактілерді көрсету -->
        <div id="contactOptions" class="contact-options">
            <a href="tel:+77777548832" class="btn btn-success contact-btn">
                <i class="fas fa-phone"></i>
            </a>
            <a href="https://wa.me/77777548832" target="_blank" class="btn btn-success contact-btn">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>
@endsection
