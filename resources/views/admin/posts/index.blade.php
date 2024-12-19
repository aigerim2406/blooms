@extends('layouts.adm')

@section('title', 'Posts Page')

@section('content')
    <h1>Posts</h1>
    <form action="{{ route('admin.posts.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Price</th>
            <th>Category</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($posts as $index => $post)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>
                    @if ($post->img)
                        <img src="{{ asset('/storage/posts/' . $post->img) }}" alt="Image" style="width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $post->price }}</td>
                <td>{{ $post->category }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No posts found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
