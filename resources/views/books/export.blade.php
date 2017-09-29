@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Dashboard</a></li>
        @role('staff')
        <li><a href="{{ url('/data/books') }}">Buku</a></li>
        @endrole
        <li class="active">Export Buku</li>
      </ul>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">Export Buku</h2>
        </div>

        <div class="panel-body">
          {!! Form::open(['url' => route('export.books.post'),
          'method' => 'post', 'class'=>'form-horizontal']) !!}

          <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
              {!! Form::label('type', 'Pilih Output', ['class'=>'col-md-2 control-label']) !!}
              <div class="col-md-4 checkbox">
                  {{ Form::radio('type', 'xls', true) }} Excel
                  {{ Form::radio('type', 'pdf') }} PDF
                  {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
              </div>
          </div>

          <div class="form-group">
            <div class="col-md-4 col-md-offset-2">
              {!! Form::submit('Download', ['class'=>'btn btn-primary']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">Export Data Buku Berdasarkan Tanggal</h2>
        </div>
        
        <div class="panel-body">
          {!! Form::open(['url' => route('export.books.post.date'),
          'method' => 'post', 'class'=>'form-horizontal']) !!}

          <div class="form-group {!! $errors->has('start_date') ? 'has-error' : '' !!}">
              {!! Form::label('start_date', 'Mulai', ['class'=>'col-md-2 control-label']) !!}
              <div class="col-md-4 checkbox">
                  {!! Form::date('start_date', null, ['class'=>'form-control']) !!}
                  {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
              </div>
          </div>

           <div class="form-group {!! $errors->has('end_date') ? 'has-error' : '' !!}">
              {!! Form::label('end_date', 'Sampai', ['class'=>'col-md-2 control-label']) !!}
              <div class="col-md-4 checkbox">
                  {!! Form::date('end_date', null, ['class'=>'form-control']) !!}
                  {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
              </div>
          </div>

          <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
              {!! Form::label('type', 'Pilih Output', ['class'=>'col-md-2 control-label']) !!}
              <div class="col-md-4 checkbox">
                  {{ Form::radio('type', 'xls', true) }} Excel
                  {{ Form::radio('type', 'pdf') }} PDF
                  {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
              </div>
          </div>

          <div class="form-group">
            <div class="col-md-4 col-md-offset-2">
              {!! Form::submit('Download', ['class'=>'btn btn-primary']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

