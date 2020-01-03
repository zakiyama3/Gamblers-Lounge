@extends('layouts.tmp')

@section('content')
    <section class="page-section" id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Profile</h2>
          </div>
        </div>
        @foreach ($users as $user)
        <div class="row text-center">
          <div class="col-lg-12">
            <span>            
              @if(is_null($user->image_url))
                <img class="profile-img" src="/storage/profileImage/default.jpeg" >
              @else
                <img class="profile-img" src="{{ $user->image_url }}">
              @endif
            </span>
            @if($user->id!=Auth::id())
            @else
            <div class="modal fade" id="modalEdit" tabindex="-1"
                  role="dialog" aria-labelledby="label1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label1">Profile Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form class="modal-body" enctype="multipart/form-data" id="postSend" method="post" action="{{ route('profileEdit') }}">
                      {{ csrf_field() }}
                      <input type="text" name="name" class="form-control" placeholder="Name" required autofocus>
                      <input type="email" name="email" class="form-control" placeholder="Email address" required>
                      <input type="password" name="password" class="form-control" placeholder="Password" required>
                      <textarea name="profile" class="form-control" cols="30" rows="3"　required></textarea>
                      <input type="file" name="imageFile" class="form-control" required>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">OK</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            @endif
            <h4 class="service-heading">{{ $user->name }}</h4>
            <i class="far fa-edit" data-toggle="modal" data-target="#modalEdit"  onMouseOut="this.style.background=''" onMouseOver="this.style.background='#fed136'"></i>
            @if(is_null($user->profile))
              <p class="text-muted">初めまして！</p>
            @else
              <p class="text-muted">{{ $user->profile }}</p>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </section>

    <section class="bg-light page-section" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Posts</h2>
          </div>
        </div>
        <div class="row">
          @foreach ($posts as $value)
          @if(is_null($value->post_image))
          @else
          <div class="col-md-4 col-sm-6 portfolio-item">
            <img class="img-fluid" src="{{ $value->post_image }}">
            <div class="portfolio-caption">
              <h4>{{ $value->post_text }}</h4>
              <a class="text-muted" href="{{ route('profile',['id' => $value->id]) }}">
                {{ $user->name }}
              </a>
              @if(is_null($value->image_url))
                <img class="img-user" src="/storage/profileImage/default.jpeg">
              @else
                <img class="img-user" src="{{ $user->image_url }}" href="{{ route('profile',['id' => $value->id]) }}">
              @endif
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </section>
    <div class="d-flex justify-content-center">
    {{ $posts->links() }}
    </div>
@endsection
