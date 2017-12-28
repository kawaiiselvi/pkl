@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Home</a></li>
				<li class="active">Barang</li>
			</ul>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Barang</h2>
				</div>
				<div class="panel-body">
					<p>
						<a class="btn btn-primary" href="{{ url('/admin/barangs/create') }}">Tambah</a>
						<a class="btn btn-info pull-right" href="{{ route('barangs.index') }}">Semua</a>
						<a class="btn btn-warning pull-right" href="{{ url('/admin/hardware') }}">Hardware</a>
						<a class="btn btn-success pull-right" href="{{ url('/admin/elektronik') }}">Elektronik</a>
					</p>
					{!! $html->table(['class'=>'table-striped']) !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
{!! $html->scripts() !!}
@endsection