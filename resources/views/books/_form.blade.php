<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  {!! Form::label('title', 'Judul *', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group {!! $errors->has('author_id') ? 'has-error' : '' !!}">
  {!! Form::label('author_id', 'Penulis *', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
{!! Form::select('author_id', [''=>'']+App\Author::pluck('name','id')->all(), null, [
  'class'=>'js-selectize',
  'placeholder' => 'Pilih Penulis']) !!}
    {!! $errors->first('author_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group {!! $errors->has('category_id') ? 'has-error' : '' !!}">
  {!! Form::label('category_id', 'Kategori *', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
{!! Form::select('category_id', [''=>'']+App\Category::pluck('nama','id')->all(), null, [
  'class'=>'js-selectize',
  'placeholder' => 'Pilih Kategori']) !!}
    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
  {!! Form::label('amount', 'Jumlah *', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::number('amount', null, ['class'=>'form-control', 'min'=>1]) !!}
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('tahun_terbit') ? ' has-error' : '' }}">
  {!! Form::label('tahun_terbit', 'Tahun Terbit *', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::number('tahun_terbit', null, ['class'=>'form-control', 'min'=>1]) !!}
    {!! $errors->first('tahun_terbit', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('penerbit') ? ' has-error' : '' }}">
  {!! Form::label('penerbit', 'Penerbit *', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::text('penerbit', null, ['class'=>'form-control']) !!}
    {!! $errors->first('penerbit', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
    {!! Form::label('deskripsi', 'Deskripsi', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('deskripsi', isset($book) ? $book->deskripsi : null, ['class'=>'form-control']) !!}
        {!! $errors->first('deskripsi', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('no_rak') ? ' has-error' : '' }}">
  {!! Form::label('no_rak', 'Nomor Rak *', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::text('no_rak', null, ['class'=>'form-control']) !!}
    {!! $errors->first('no_rak', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
  {!! Form::label('cover', 'Cover', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::file('cover') !!}
    @if (isset($book) && $book->cover)
      <p>
      {!! Html::image(asset('img/'.$book->cover), null, ['class'=>'img-rounded img-responsive']) !!}
      </p>
    @endif
    {!! $errors->first('cover', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-4 col-md-offset-2">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>
