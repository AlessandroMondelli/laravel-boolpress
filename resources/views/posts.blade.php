@extends('layouts.public')

@section('content')
    <div class="container cont-posts">
        <div class="row">
            <div class="col-lg-6">
                <h1>Lista posts pubblica</h1>
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
                        <p class="card-text">Categoria: {{ $post->category->name }}</p>
                    @endif
                    <p class="card-text">Autore: {{ $post->author }}</p>
                    <a href="{{ route('blog.show',['slug'=>$post->slug]) }}" class="btn btn-primary">Dettagli</a>
                  </div>
                </div>
            </div>
        @empty
            <p>Non è presente alcun Post</p>
        @endforelse
        </div>
    </div>
@endsection
