@extends('layouts.tmp')

@section('content')
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in">Welcome To Gamblers Lounge!</div>
      </div>
    </div>
  </header>

  <section class="bg-light page-section" id="portfolio">
      <div class="row">
        @foreach($posts as $value)
        <div class="col-md-4 col-sm-6 portfolio-item">
            <img class="img-fluid" src="{{ $value->post_image }}">
          <div class="portfolio-caption">
            <h4>{{ $value->post_text }}</h4>
            <a class="text-muted" href="{{ route('profile',['id' => $value->id]) }}">
              {{ $value->name }}
            </a>
            <a href="{{ route('profile',['id' => $value->id]) }}">
            @if(is_null($value->image_url))
              <img class="img-user" src="/storage/profileImage/default.jpeg" >
            @else
              <img class="img-user" src="{{ $value->image_url }}" alt="">
            @endif
            </a>
            @if($value->id == Auth::id())
            <div id="fa-icon">
              <p>
                <i class="far fa-edit" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#fed136'" data-toggle="modal" data-target="#modalPostEdit{{ $value->post_id }}"></i>
                <i class="fas fa-trash" onMouseOut="this.style.background=''" onMouseOver="this.style.background='#fed136'" data-toggle="modal" data-target="#modalPostDelete{{ $value->post_id }}"></i>
              </p>
            </div>
            @endif
          </div>
        </div>
        @endforeach
      </div>
  </section>

  <div class="modal fade" id="modalPost" tabindex="-1"
        role="dialog" aria-labelledby="label1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="label1">Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="modal-body" enctype="multipart/form-data" id="postSend" method="post" action="route('mainPost')">
            {{ csrf_field() }}
            <textarea name="userPost" class="form-control" cols="30" rows="3" required autofocus></textarea>
            <input type="file" name="imageFile" class="form-control" required>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit">OK</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  @foreach($posts as $valueEdit)
  <div class="modal fade" id="modalPostEdit{{ $valueEdit->post_id }}"　tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
    <div class="modal-dialog"　role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="label1">Post Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="modal-body" enctype="multipart/form-data" id="postEdit" method="post" action="{{ route('mainPostEdit') }}">
          {{ csrf_field() }}
          <input type="hidden" name="postId" class="form-control" value="{{ $valueEdit->post_id }}" required>
          <textarea name="postText" class="form-control" cols="30" rows="3"　required></textarea>
          <input type="file" name="imageFile" class="form-control" required>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">OK</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalPostDelete{{ $valueEdit->post_id }}" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
    <div class="modal-dialog"　role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="label1">Post Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="modal-body" enctype="multipart/form-data" id="postEdit" method="post" action="{{ route('mainPostDelete') }}">
            {{ csrf_field() }}
            <input type="hidden" name="postId" class="form-control" value="{{ $valueEdit->post_id }}" required>
            <p>Is it OK to delete it?</p>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit">OK</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
  <div class="d-flex justify-content-center">
    {{ $posts->links() }}
  </div>
@endsection
