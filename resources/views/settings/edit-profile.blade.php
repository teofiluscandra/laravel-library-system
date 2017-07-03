@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li class="active">Ubah Profil</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Profil</h2>
          </div>

          <div class="panel-body">
            {!! Form::model(auth()->user(), ['url' => url('/settings/profile'),
            'method' => 'post', 'class'=>'form-horizontal']) !!}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              {!! Form::label('name', 'Nama', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {!! Form::label('email', 'Email', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
              {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::text('tempat_lahir', $member->tempat_lahir, ['class'=>'form-control']) !!}
                {!! $errors->first('tempat_lahir', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
              {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::date('tanggal_lahir', $member->tanggal_lahir, ['class'=>'form-control']) !!}
                {!! $errors->first('tanggal_lahir', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('no_identitas') ? ' has-error' : '' }}">
              {!! Form::label('no_identitas', 'Nomor Identitas', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::text('no_identitas', $member->no_identitas, ['class'=>'form-control']) !!}
                {!! $errors->first('no_identitas', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
                  {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'col-md-4 control-label']) !!}
                  <div class="col-md-6">
                      {!! Form::radio('jenis_kelamin', 'Laki-laki', ($member->jenis_kelamin == 'Laki-laki')) !!}
                      {!! Form::label('role', 'Laki-laki', ['class' => 'control-label']) !!}
                      {!! Form::radio('jenis_kelamin', 'Perempuan', ($member->jenis_kelamin == 'Perempuan')) !!}
                      {!! Form::label('role', 'Perempuan', ['class' => 'control-label']) !!}
                  </div>
              </div>

            <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
              {!! Form::label('alamat', 'Alamat', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::textarea('alamat', $member->alamat, ['class'=>'form-control']) !!}
                {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

