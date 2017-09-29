@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li class="active">Ubah Setting</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Setting</h2>
          </div>

          <div class="panel-body">
            {!! Form::model($setting, ['url' => url('/data/settings/library'), 'files' => true,
            'method' => 'post', 'class'=>'form-horizontal']) !!}

            <div class="form-group{{ $errors->has('biaya_denda') ? ' has-error' : '' }}">
              {!! Form::label('biaya_denda', 'Biaya Denda', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::number('biaya_denda', null, ['class'=>'form-control']) !!}
                {!! $errors->first('biaya_denda', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group{{ $errors->has('maksimal_hari') ? ' has-error' : '' }}">
              {!! Form::label('maksimal_hari', 'Jumlah Hari Maximal', ['class'=>'col-md-4 control-label']) !!}
              <div class="col-md-6">
                {!! Form::number('maksimal_hari', null, ['class'=>'form-control']) !!}
                {!! $errors->first('maksimal_hari', '<p class="help-block">:message</p>') !!}
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

