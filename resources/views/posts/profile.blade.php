@extends('layouts.app')
@section('title','My page')
@section('content')
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-200">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                 style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; background: rgba(248,143,195,0.97);
                                 -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
                                 linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));">
                                <img src="{{asset(Auth::user()->image)}}"
                                     alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                <h5>{{Auth::user()->name}}</h5>
                                <form action="{{route('posts.editregister',Auth::user()->id)}}" method="get">
                                    @csrf
                                    <button type="submit" style="margin-right: 0.5rem" class="btn btn-outline-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{Auth::user()->email}}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted">+7 777 767 5454</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <center><h2>My Orders</h2></center>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <th scope="row">1</th>
                    <td><img width="80" height="80" src="{{asset($item->img)}}" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;"></td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->pivot->status}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
