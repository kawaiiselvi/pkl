@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<h2 class="panel-title" face="britannic bold" color="#90EE90">Daftar Barang</h2>
				</div>
				<div class="panel-body">
					<p>
					<a class="btn btn-info pull-right" href="{{ url('/') }}">Semua</a>
					<a class="btn btn-warning pull-right" href="{{ url('/member/hardware') }}">Hardware</a>
					<a class="btn btn-success pull-right" href="{{ url('/member/elektronik') }}">Elektronik</a>
					</p>
					</div>
					{!! $html->table(['class'=>'table-striped']) !!}
				
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
{!! $html->scripts() !!}
@endsection