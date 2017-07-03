@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/data/staff') }}">Staff</a></li>
          <li class="active">Ubah Staff</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Staff</h2>
          </div>

          <div class="panel-body">
            {!! Form::model($staff, ['url' => route('staff.update', $staff->id),
              'method'=>'put', 'class'=>'form-horizontal']) !!}
            @include('staff._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


