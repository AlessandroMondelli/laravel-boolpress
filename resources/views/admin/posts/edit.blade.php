@extends('layouts.admin')

@section('title','Modifica post')

@section('content')
<main>
    <div id="create">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-info float-right">Home</a>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('admin.posts.update',['post'=>$post->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tipo">Titolo Post</label>
                        <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Inserire titolo"></input>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Autore</label>
                        <input type="text" name="author" value="{{ $post->author }}" class="form-control" placeholder="Inserire autore"></input>
                    </div>
                    <div class="form-group">
                        <label for="tipo">A cosa stai pensando?</label>
                        <textarea name="content" class="form-control" rows="4" cols="50" placeholder="Scrivi qualcosa...">{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="Invia" value="Modifica">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
