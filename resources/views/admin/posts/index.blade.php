@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 videogame-card">
                <h1>Lista gestione posts</h1>
            </div>
        </div>
        <div class="row">
            @forelse ($posts as $post)
            <div class="col-lg-12 post-card">
                <div class="card">
                  <div class="card-body">
                    <h2><p class="card-title">{{ $post->title }}</p></h2>
                    <p class="card-text">{{ $post->content }}</p>
                    <p class="card-text">Autore: {{ $post->author }}</p>
                    <p class="card-text">Slug: {{ $post->slug }}</p>
                    <a href="#" class="btn btn-primary">Dettagli</a>
                    <a href="#" class="btn btn-warning">Modifica</a>
                    <form class="" action="#" method="post">
                        {{-- @csrf
                        @method('DELETE') --}}
                        <input type="submit" class="btn btn-danger" value="Elimina">
                    </form>
                  </div>
                </div>
            </div>
        @empty
            <p>Non è presente alcun Post</p>
        @endforelse
        </div>
    </div>
@endsection
