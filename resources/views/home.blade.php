@extends('layouts.backend.app')
@section('title', 'Home')
@section('content_title', 'Home')
@section('content')
<x-alert></x-alert>
<div class="row">
	<div class="col-lg">
		<div class="jumbotron">
		@role('admin')
		  <h1 class="display-4">Hello, {{ Universe::admin()->nama_admin }}!</h1>
		@endrole
		  <p class="lead">Selamat datang di WEB SIMOPOKTAN.</p>
		  <hr class="my-4">
		</div>
	</div>
</div>
@endsection