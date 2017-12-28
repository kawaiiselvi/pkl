@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <center>
                <div class="panel-heading">
                <font size="6" face="Impact" color="#1E90FF">Perang.com</font>
                </div>
                </center>
                
                <div class="panel-body">
                   
                    {!! Form::open(['url'=>'login', 'class'=>'form-horizontal']) !!}
                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                        {!! Form::label('email','Email',['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::email('email',null,['class'=>'form-control']) !!}
                            {!! $errors->first('email','<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? 'has-error' : '' }}">
                        {!! Form::label('password','Password',['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::password('password',['class'=>'form-control']) !!}
                            {!! $errors->first('password','<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('remember') !!} Ingat Saya
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"> </span>
                                <i class="fa fa-btn fa-sign-in"></i>Login
                            </button>
                            <a href="{{ url('/password/reset')}}" class="btn btn-link">Lupa Password</a>
                        </div>
                    </div>

                    <font size="5" face="Impact" color="#1E90FF">________________________</font>

                    <center><b>Tidak Punya Akun?</b><a href="{{ url('/register') }}"> Buat akun</a></center>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection