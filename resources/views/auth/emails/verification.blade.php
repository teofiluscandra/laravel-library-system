Klik link berikut untuk melakukan aktivasi akun:
<a href="{{ $link = url('auth/verify', $token).'?email='.urlencode($user->email) }}"> {{ $link }} </a>

