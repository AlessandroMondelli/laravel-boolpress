@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1>Lista gestione posts</h1>
            </div>
            <div class="col-lg-6">
                <a class="btn btn-success float-right" href="{{ route('admin.posts.create') }}">Crea nuovo post</a>
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
                    <p class="card-text">Slug: {{ $post->slug }}</p>
                    <a href="{{ route('admin.posts.show',['post'=>$post->id]) }}" class="btn btn-primary">Dettagli</a>
                    <a href="{{ route('admin.posts.edit',['post'=>$post->id]) }}" class="btn btn-warning">Modifica</a>
                    <form class="" action="{{ route('admin.posts.destroy',['post'=>$post->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
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
