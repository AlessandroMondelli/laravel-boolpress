@extends('layouts.public')

@section('content')
    <div class="container cont-posts">
        <div class="row">
            <div class="col-lg-12">
                <h1>Visualizzazione Post</h1>
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
                        <p class="card-text">Categoria: {{ $post->category->name }}</p>
                    @endif
                    <p class="card-text">Autore: {{ $post->author }}</p>
                    <p class="card-text">Creato: {{ $post->created_at }}</p>
                    <p class="card-text">Aggiornato: {{ $post->updated_at }}</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
