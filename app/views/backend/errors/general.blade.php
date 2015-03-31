@extends('admin-theme-laravel-layout::layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Sorry, an error occurred</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            <p>We're sorry, but a server error has occurred.</p>
            <p>Code {{{ $exception->getStatusCode() }}}</p>
        </div>
    </div>
@stop
