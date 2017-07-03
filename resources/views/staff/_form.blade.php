<div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
  {!! Form::label('nip', 'NIP', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::text('nip', isset($staff) ? $staff->staff->nip : null, ['class'=>'form-control']) !!}
    {!! $errors->first('nip', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
  {!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
  {!! Form::label('email', 'Email', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
  </div>
</div>

{{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('password', 'Password', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::password('password', ['class'=>'form-control']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    {!! Form::label('password_confirmation', 'Konfirmasi Password', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

<div class="form-group{{ $errors->has('telp') ? ' has-error' : '' }}">
  {!! Form::label('telp', 'Nomor Telepon', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::text('telp', isset($staff) ? $staff->staff->telp : null, ['class'=>'form-control']) !!}
    {!! $errors->first('telp', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::radio('jenis_kelamin', 'Laki-laki', isset($staff) ? ($staff->staff->jenis_kelamin == 'Laki-laki') : true) !!}
        {!! Form::label('role', 'Laki-laki', ['class' => 'control-label']) !!}
        {!! Form::radio('jenis_kelamin', 'Perempuan', isset($staff) ? ($staff->staff->jenis_kelamin == 'Perempuan') : false) !!}
        {!! Form::label('role', 'Perempuan', ['class' => 'control-label']) !!}
    </div>
</div>

<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
    {!! Form::label('alamat', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('alamat', isset($staff) ? $staff->staff->alamat : null, ['class'=>'form-control']) !!}
        {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
  <div class="col-md-4 col-md-offset-2">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>
