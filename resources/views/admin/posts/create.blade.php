@extends('layouts.admin')

@section('title','Crea post')

@section('content')
<main>
    <div id="create">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-info float-right upper-btn">Home</a>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titolo Post</label>
                        <input type="text" name="title" class="form-control" placeholder="Inserire titolo"></input>
                    </div>
                    <div class="form-group">
                        <label for="author">Autore</label>
                        <input type="text" name="author" class="form-control" placeholder="Inserire autore"></input>
                    </div>
                    <div class="form-group">
                        <label for="content">A cosa stai pensando?</label>
                        <textarea name="content" class="form-control"  rows="4" cols="50" placeholder="Scrivi qualcosa..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover_image">Inserisci un'immagine</label>
                        <input type="file" name="cover_image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Crea">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
