@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Register Doctor</h1>
@stop

@section('content')

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

    <div id="app">
        {{ csrf_field() }}
        <doctors-register></doctors-register>
    </div>

@stop