@extends('layouts.public')

@section('content')
<main>
    <div class="container cont-posts">
        <div class="row">
            <div class="col-md-12">
                <div id="insert-data">
                    <h1>{{ __('messages.contact_title') }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('contatti.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">{{ __('messages.name_form') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('messages.name_placeholder') }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="author">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="{{ __('messages.email_placeholder') }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="content">{{ __('messages.object_form') }}</label>
                        <input type="text" name="subject" class="form-control" placeholder="{{ __('messages.object_form') }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="content">{{ __('messages.content_form') }}</label>
                        <textarea name="message" class="form-control"  rows="4" cols="50" placeholder="{{ __('messages.content_form') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Invia">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
