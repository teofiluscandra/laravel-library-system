@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/data/members') }}">Member</a></li>
          <li class="active">Ubah Member</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Member</h2>
          </div>

          <div class="panel-body">
            {!! Form::model($member, ['url' => route('members.update', $member->id),
              'method'=>'put', 'class'=>'form-horizontal']) !!}
            @include('members._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


