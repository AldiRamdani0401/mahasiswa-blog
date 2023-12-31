@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h1 class="mb-3">{{ $post->title }}</h1>
            <a href="/dashboard/post-settings/{{ $post->user_id }}/detail" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all posts</a>
            <a href="/dashboard/post-settings/edit/{{ $post->slug }}" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/post-settings/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <!-- Include the id as a hidden input -->
                <input type="hidden" name="id" value="{{ $post->id }}">
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                    <span data-feather="x-circle"></span> Delete
                </button>
            </form>

            @if ($post->image)
            <div style="max-height: 350px; overflow:hidden; ">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            </div>
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            @endif

            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>

        </div>
    </div>
</div>

@endsection