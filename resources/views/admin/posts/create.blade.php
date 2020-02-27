@extends('layouts.admin')

@section('title','Crea post')

@section('content')
<main>
    <div id="create">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Crea un nuovo post</h1>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-info float-right upper-btn">Home</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                </div>
                <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titolo Post</label>
                        <input type="text" name="title" class="form-control" placeholder="Inserire titolo" value="{{ old('title') }}"></input>
                    </div>
                    <select name="category_id" class="form-group">
                        <option value="">Seleziona categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                            {{-- Validazione --}}
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="author">Autore</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author') }}" placeholder="Inserire autore"></input>
                    </div>
                    <div class="form-group">
                        <label for="content">A cosa stai pensando?</label>
                        <textarea name="content" class="form-control"  rows="4" cols="50" placeholder="Scrivi qualcosa...">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover_image">Inserisci un'immagine (max 30kb)</label>
                        <input type="file" name="cover_image" class="form-control-file">
                    </div>
                    @if ($tags->count() > 0)
                        <p>Seleziona tag:</p>
                        @foreach ($tags as $tag)
                            <label for="tag_{{ $tag->id }}">
                                <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}"
                                @if (!empty(old("tag_id")))
                                    {{-- Validazione --}}
                                    {{ in_array($tag->id, old("tag_id")) ? 'checked' : '' }}
                                @endif
                                >
                                {{ $tag->name }}
                            </label>
                        @endforeach
                    @endif
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Crea">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
