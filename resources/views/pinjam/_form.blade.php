<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
  {!! Form::label('nomor_peminjaman', 'Nomor Peminjaman', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::text('nomor_peminjaman', $id, ['class'=>'form-control']) !!}
    {!! $errors->first('nomor_peminjaman', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group {!! $errors->has('user_id') ? 'has-error' : '' !!}">
  {!! Form::label('user_id', 'Member ID', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
{!! Form::select('user_id', [''=>'']+App\Member::pluck('kode_member','id')->all(), null, [
  'class'=>'js-selectize',
  'placeholder' => 'Pilih Member']) !!}
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group {!! $errors->has('books') ? 'has-error' : '' !!}">
  {!! Form::label('books', 'Kode Buku', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
{!! Form::select('books[]', [''=>'']+App\Book::pluck('kode_buku','id')->all(), null, [
  'class'=>'js-selectize',
  'placeholder' => 'Pilih Buku']) !!}
  {!! Form::select('books[]', [''=>'']+App\Book::pluck('kode_buku','id')->all(), null, [
  'class'=>'js-selectize',
  'placeholder' => 'Pilih Buku']) !!}
  {!! Form::select('books[]', [''=>'']+App\Book::pluck('kode_buku','id')->all(), null, [
  'class'=>'js-selectize',
  'placeholder' => 'Pilih Buku']) !!}
    {!! $errors->first('books', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-4 col-md-offset-2">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>
