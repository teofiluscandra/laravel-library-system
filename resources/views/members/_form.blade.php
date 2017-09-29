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
</div> --}}

<div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
  {!! Form::label('foto', 'Foto', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
    {!! Form::file('foto') !!}
    @if (isset($member) && $member->members->foto)
      <p>
      {!! Html::image(asset('img/'.$member->members->foto), null, ['class'=>'img-rounded img-responsive']) !!}
      </p>
    @endif
    {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
    {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('tempat_lahir', isset($member) ? $member->members->tempat_lahir : null, ['class'=>'form-control']) !!}
        {!! $errors->first('tempat_lahir', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::date('tanggal_lahir', isset($member) ? $member->members->tanggal_lahir : null, ['class'=>'form-control']) !!}
        {!! $errors->first('tanggal_lahir', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('no_identitas') ? ' has-error' : '' }}">
    {!! Form::label('no_identitas', 'Nomor Identitas', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::text('no_identitas', isset($member) ? $member->members->no_identitas : null, ['class'=>'form-control']) !!}
        {!! $errors->first('no_identitas', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::radio('jenis_kelamin', 'Laki-laki', isset($member) ? ($member->members->jenis_kelamin == 'Laki-laki') : true) !!}
        {!! Form::label('role', 'Laki-laki', ['class' => 'control-label']) !!}
        {!! Form::radio('jenis_kelamin', 'Perempuan', isset($member) ? ($member->members->jenis_kelamin == 'Perempuan') : false) !!}
        {!! Form::label('role', 'Perempuan', ['class' => 'control-label']) !!}
    </div>
</div>

<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
    {!! Form::label('alamat', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('alamat', isset($member) ? $member->members->alamat : null, ['class'=>'form-control']) !!}
        {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
  <div class="col-md-4 col-md-offset-2">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>
