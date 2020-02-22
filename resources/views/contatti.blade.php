@extends('layouts.public')

@section('content')
<main>
    <div class="container cont-posts">
        <div class="row">
            <div id="insert-data">
                <h1>Inserisci i dati per inviarci un messaggio</h1>
            </div>
            <form action="{{ route('contatti.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Nome</label>
                    <input type="text" name="name" class="form-control" placeholder="Inserire Nome"></input>
                </div>
                <div class="form-group">
                    <label for="author">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Inserire Email"></input>
                </div>
                <div class="form-group">
                    <label for="content">Oggetto</label>
                    <input type="text" name="subject" class="form-control" placeholder="Oggetto"></input>
                </div>
                <div class="form-group">
                    <label for="content">Messaggio</label>
                    <textarea name="message" class="form-control"  rows="4" cols="50" placeholder="Scrivi qualcosa..."></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Invia">
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
