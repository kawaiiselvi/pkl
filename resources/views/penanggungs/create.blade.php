@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Home</a></li>
				<li><a href="{{ url('/admin/penanggungs') }}">Penanggung Jawab</a></li>
				<li class="active">Tambah</li>
			</ul>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Tambah</h2>
				</div>
				<div class="panel-body">
					{!! Form::open(['url'=>route('penanggungs.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
					@include('penanggungs._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection