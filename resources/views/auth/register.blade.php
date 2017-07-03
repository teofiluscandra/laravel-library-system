@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'/register', 'class'=>'form-horizontal']) !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Nama Lengkap', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'Alamat Email', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::email('email', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password', 'Password', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::password('password', ['class'=>'form-control']) !!}
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {!! Form::label('password_confirmation', 'Konfirmasi Password', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                        {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('tempat_lahir', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('tempat_lahir', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
                        {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::date('tanggal_lahir', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('tanggal_lahir', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('no_identitas') ? ' has-error' : '' }}">
                        {!! Form::label('no_identitas', 'Nomor Identitas', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('no_identitas', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('no_identitas', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                        {!! Form::label('alamat', 'Alamat', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::textarea('alamat', null, ['class'=>'form-control']) !!}
                            {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
                        {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::radio('jenis_kelamin', 'Laki-laki', true) !!}
                            {!! Form::label('role', 'Laki-laki', ['class' => 'control-label']) !!}
                            {!! Form::radio('jenis_kelamin', 'Perempuan') !!}
                            {!! Form::label('role', 'Perempuan', ['class' => 'control-label']) !!}
                        </div>
                    </div>
                    

                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <div class="col-md-offset-4 col-md-6">
                            {!! app('captcha')->display() !!}
                            {!! $errors->first('g-recaptcha-response', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Daftar
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
