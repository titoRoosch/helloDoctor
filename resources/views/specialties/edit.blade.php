@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Edit specialty</h1>
@stop

@section('content')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
    var specialtyId = {{ $specialtyId }}; // this should be your PHP data `json_encode()`ed. This should render to the string "{value: 'hello', inputValue: 999}" or else JS will error
</script>
    <div id="app">
        {{ csrf_field() }}
        <specialties-update></specialties-update>
    </div>
@stop