@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Home</h2>
				</div>
				<div class="panel-body">
                    <font size="5" face="Bradley Hand ITC" color="#90EE90">Selamat Datang Perang.com Silahkan Pilih Menu yang Anda Inginkan^^</font> 
                </div>
					<table class="table">
						<tbody>
							<tr>
								<td class="text-muted">Barang Dipinjam</td>
								<td>
									@if ($borrowLogs->count()==0)
									Tidak Ada Barang Yang Dipinjam
									@endif
									<ul>
										@foreach ($borrowLogs as $borrowLog)
										<li>
											{!! Form::open(['url'=>route('member.barangs.return', $borrowLog->barang_id), 'method'=>'put', 'class'=>'form-inline js-confirm', 'data-confirm'=>"Yakin Ingin Mengembalikan ".$borrowLog->barang->title." ?"]) !!}
											{!! Form::submit('Kembalikan',['class'=>'btn btn-xs btn-default']) !!}
											{{ $borrowLog->barang->title }}
											
											{!! Form::close() !!}
										</li>
										@endforeach
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection