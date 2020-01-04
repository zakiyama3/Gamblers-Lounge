@extends('layouts.loginSigh')

@section('content')

<div class="container">
    <div class="card card-container" id="profile-title">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <span id="reauth-email" class="reauth-email"></span>
        <form class="form-signin" method="post" action="{{ route('login') }}">
          {{ csrf_field() }}
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
              <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                  </label>
              </div>
              <div>
                  <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" >Check</button>
              </div>
          </form>
          <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
              Forgot Your Password?
          </a> -->
    </div>
</div>
@endsection
