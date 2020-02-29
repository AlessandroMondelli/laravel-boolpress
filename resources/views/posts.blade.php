@extends('layouts.public')

@section('content')
    <div class="container cont-posts">
        <div class="row">
            <div class="col-lg-6">
                <h1>{{ __('post_form.post_index_title') }}</h1>
            </div>
            <div class="col-lg-6">
                <a class="btn btn-success float-right" href="{{ route('public.home') }}">Home</a>
            </div>
        </div>
        <div class="row">
            @forelse ($posts as $post)
            <div class="col-lg-12 post-card">
                <div class="card">
                  <div class="card-body">
                    <h2><p class="card-title">{{ $post->title }}</p></h2>
                    <p class="card-text">{{ $post->content }}</p>
                    @if (!empty($post->category))
                        <p class="card-text">{{ __('post_form.post_category') }}: {{ $post->category->name }}</p>
                    @endif
                    <p class="card-text">{{ __('post_form.post_author') }}: {{ $post->author }}</p>
                    <a href="{{ route('blog.show',['slug'=>$post->slug]) }}" class="btn btn-primary">{{ __('post_form.details_button') }}</a>
                  </div>
                </div>
            </div>
        @empty
            <p>{{ __('post_form.no_posts_message') }}</p>
        @endforelse
        </div>
    </div>
@endsection
