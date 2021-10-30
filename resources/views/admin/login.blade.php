@extends('admin.admin_master')

@section('admin_content')
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

<div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
  <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin Login</span></div>
<hr>
<form method="POST" action="{{ route('admin.login') }}">
                        @csrf
  <div class="form-group">
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your Email">
    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
  </div><!-- form-group -->
  <div class="form-group">
    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your Password">
    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
  </div><!-- form-group -->
  <button type="submit" class="btn btn-info btn-block">Log In</button>
</form>

</div><!-- login-wrapper -->
</div><!-- d-flex -->
@endsection
