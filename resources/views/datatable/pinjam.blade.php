

<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Jumlah Barang Yang Akan Dipinjam</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['url'=>('/pinjam'), 'method'=>'post', 'files'=>'true','class'=>'form-horizontal']) !!}
			<div class="form-group{{ $errors->has('amount') ? 'has-error' : '' }}">
	{!! Form::label('amount','Jumlah',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::number('amount',null,['class'=>'form-control']) !!}
		{!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>
		{!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>