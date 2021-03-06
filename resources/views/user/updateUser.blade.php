@extends('layouts.app')@section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 ">
      <div class="card">
        <div class="card-header">Update User</div>
        <div class="row">
          <div class="card-body col-md-8">
            <form method="POST" action="{{ route('users.confirm_update') }}" enctype="multipart/form-data"> @csrf <div
                class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-6 col-10">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ $users->name }}" autocomplete="name" autofocus> @error('name') <span
                    class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span> @enderror </div>
                <label class="col-md-1 col-2 col-form-label text-md-left text-danger">*</label>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                <div class="col-md-6 col-10">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $users['email'] }}" autocomplete="email">@error('email') <span class="invalid-feedback"
                    role="alert">
                    <strong>{{ $message }}</strong>
                  </span> @enderror </div>
                <label class="col-md-1 col-2 col-form-label text-md-left text-danger">*</label>
              </div>
              <!-- // for only admin --> @if(auth()->user()->type==0) <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                <div class="col-md-6 col-10"> <select name="type" id="type"
                    class="form-control @error('type') is-invalid @enderror">
                    <option value="">Choose</option>
                    <option value="0">Admin</option>
                    <option value="1">User</option>
                  </select>@error('type') <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span> @enderror </div>
                <label class="col-md-1 col-2 col-form-label text-md-left text-danger">*</label>
              </div> @else <input type="text" name="type" value="1" hidden> @endif <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6 col-10">
                  <input id="phone" type="phone" class="form-control" name="phone" value="{{$users['phone']}}"
                    autocomplete="phone">
                </div>
              </div>
              <div class="form-group row">
                <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                <div class="col-md-6 col-10">
                  <input type='date' name="dob" id="dob" class="form-control" value="{{$users['dob']}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-6 col-10">
                  <textarea id="address" class="form-control" name="address"
                    style="height:100px;width:100%;resize:none;">{{$users['address']}}</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="profile" class="col-md-4 col-form-label text-md-right">Profile</label>
                <div class="col-md-6 col-10">
                  <input id="profile" type="file" onchange="loadFile(event)"
                    class="form-control mb-3 @error('profile') is-invalid @enderror" name="profile">@error('profile')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span> @enderror </div>
                <label class="col-md-1 col-2 col-form-label text-md-left text-danger">*</label>
              </div>
              <div class="d-flex justify-content-center ">
                @if(!file_exists(public_path().'/profile_img/{{$users->id}}/image/{{$users->profile}}')) <img
                  src="/profile_img/{{$users->id}}/image/{{$users->profile}}" class="default_img"
                  alt="{{$users->profile}}" width="200"> @else <img src="/image/default_img.png" class="default_img"
                  alt="default_img.png" width="200"> @endif </div>
              <div class="form-group row">
                  <p>{{$users['id']}}</p>
    @if(Auth::user()->id == $users['id'])
                 <a class="col-md-4 col-form-label text-md-right ml-3" href="{{ route('users.showchangePass',$users['id'])}}">Change Password</a>
    @endif
              </div>
              <div class="col-md-6 col-10 m-auto">
                <button type="submit" class="btn btn-primary mr-3">Confirm</button>
                <button type="reset" class="btn btn-primary" onclick="resetimg()">Clear</button>
              </div>
            </form>
          </div>
          <div class="form-group col-md-2 col-10 d-sm-none d-none d-md-block">
            <div class="mt-5 mr-5 w-100">
              @if(!file_exists(public_path()."/profile_img/{{$users->id}}/image/{{$users->profile}}")) <img
                src="/profile_img/{{$users->id}}/image/{{$users->profile}}" class="default_img"
                alt="{{$users->profile}}" style="width:100%;"> @else <img src="/image/default_img.png"
                class="default_img" alt="default_img" style="width:100%;"> @endif </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
