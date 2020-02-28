@extends('layouts.public')

@section('content')
    <div class="container cont-posts">
        <div class="row">
            <div class="col-lg-12">
                <h1>{{ __('post_form.post_details_title') }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 post-card">
                <div class="card">
                  <div class="card-body">
                    <h2><p class="card-title">{{ $post->title }}</p></h2>
                    <img class="cover_img" src="{{ $post->cover_image ? asset('storage/' . $post->cover_image) : asset('storage/uploads/notAvailable.png') }}" alt=" Immagine di {{ $post->title }}">
                    <p class="card-text">{{ $post->content }}</p>
                    @if (!empty($post->category))
                        <p class="card-text">{{ __('post_form.post_category') }}: <a href="{{ route('blog.category',['slug' => $post->category->slug]) }}">{{ $post->category->name }}</a></p>
                    @endif
                    <p class="card-text">{{ __('post_form.post_author') }}: {{ $post->author }}</p>
                    <p class="card-text">{{ __('post_form.post_created') }}: {{ $post->created_at }}</p>
                    <p class="card-text">{{ __('post_form.post_updated') }}: {{ $post->updated_at }}</p>
                    @if (($post->tags)->isNotEmpty())
                        <p class="card-text">Tags:
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('blog.tag',['slug'=>$tag->slug]) }}">{{ $tag->name }}{{ $loop->last ? '' : ',' }}</a>
                            @endforeach
                        </p>
                    @endif
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
