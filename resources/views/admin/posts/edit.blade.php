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
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                </div>
                <form action="{{ route('admin.posts.update',['post'=>$post->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tipo">Titolo Post</label>
                        <input type="text" name="title" value="@if(empty(old("title"))){{ $post->title }}@else{{ old("title") }}@endif"
                        class="form-control" placeholder="Inserire titolo"></input>
                    </div>
                    <select name="category_id" class="form-group">
                        <option value="">Nessuna categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                 @if (!empty(old("category_id")))
                                    {{-- Validazione se presente old --}}
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                @else
                                    {{-- Validazione se non presente old --}}
                                    {{ $post->category && ($post->category->id == $category->id) ? 'selected' : ''}}>
                                @endif
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="tipo">Autore</label>
                        <input type="text" name="author" value="@if(empty(old("author"))){{ $post->author }}@else{{ old("author") }}@endif" class="form-control" placeholder="Inserire autore"></input>
                    </div>
                    <div class="form-group">
                        <label for="tipo">A cosa stai pensando?</label>
                        <textarea name="content" class="form-control" rows="4" cols="50" placeholder="Scrivi qualcosa...">@if(empty(old("content"))){{ $post->content }}@else{{ old("content") }}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover_image">Inserisci un'immagine</label>
                        <input type="file" name="cover_image" class="form-control-file">
                    </div>
                    @if ($tags->count() > 0)
                        <p>Seleziona tag:</p>
                        @foreach ($tags as $tag)
                            <label>
                                <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}"
                                @if (!empty(old("tag_id")))
                                    {{-- Validazione se presente old --}}
                                    {{ in_array($tag->id, old("tag_id")) ? 'checked' : '' }}>
                                @else
                                    {{--altrimenti metto quelli già presenti in precedenza --}}
                                    {{ ($post->tags)->contains($tag) ? 'checked' : '' }}>
                                @endif
                                {{ $tag->name }}
                            </label>
                        @endforeach
                    @endif
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Modifica">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
