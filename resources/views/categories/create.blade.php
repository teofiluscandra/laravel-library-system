@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/data/categories') }}">Kategori</a></li>
          <li class="active">Tambah Kategori</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Tambah Kategori</h2>
          </div>

          <div class="panel-body">
            {!! Form::open(['url' => route('categories.store'),
            'method' => 'post', 'class'=>'form-horizontal']) !!}
            @include('categories._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

