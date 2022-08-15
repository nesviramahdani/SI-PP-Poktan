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
		@role('penyuluh')
		 <h1 class="display-4">Hello, {{ Universe::penyuluh()->nama_penyuluh }}!</h1><br>
		  <p class="lead">Selamat datang di WEB SIMOPOKTAN.</p>
		  <hr class="my-4">
		  @endrole
		  @role('kelompoktani')
		  <h1 class="display-4">Hello, {{ Universe::kelompoktani()->nama_kelompoktani }}!</h1><br>
		   <p class="lead">Selamat datang di WEB SIMOPOKTAN.</p>
		   <hr class="my-4">
		   @endrole
		</div>
	</div>
</div>
@endsection