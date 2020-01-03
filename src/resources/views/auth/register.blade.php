@extends('layouts.loginSigh')

@section('content')
    <div class="container">
        <div class="card card-container" id="profile-title">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <span id="reauth-email" class="reauth-email"></span>
              <form class="form-signin" enctype="multipart/form-data" method="post" action="{{ route('register') }}">
                  {{ csrf_field() }}
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                  <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" value="{{ old('name') }}" required autofocus>


                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required>

                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation" required>

                  <div id="remember" class="checkbox">
                      <label>
                          <input type="checkbox" value="remember-me"> Remember me
                      </label>
                  </div>
                  <div>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" >Check</button>
                  </div>
              </form>
        </div>
    </div>
@endsection
