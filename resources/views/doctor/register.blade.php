@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
        <!--Sucess Alert-->
        <div class="container" style="display:none;" id="myAlert">
            <div class="alert alert-success alert-dismissable" id="myAlert2">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            </div>
        </div>
    <h1>Register Doctor</h1>
@stop

@section('content')

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

    <div id="app">
        <doctors-register></doctors-register>
    </div>

@stop