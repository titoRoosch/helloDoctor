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
    <h1>Specialties List</h1>
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
        <specialties-list></specialties-list>
    </div>

</div>
@stop