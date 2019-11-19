@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Doctors List</h1>
@stop

@section('content')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

<div class="main-content-container container-fluid px-4">
    
    <!--<div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle"></span>
        </div>
    </div>-->
    
    <div id="app">
        {{ csrf_field() }}
        <doctors-list></doctors-list>
    </div>

</div>
@stop