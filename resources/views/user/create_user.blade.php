@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create User</div>
        <div class="card-body">
          <form method="POST" action="{{ route('users.confirm_create') }}" enctype="multipart/form-data"> @csrf <div
              class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  value="{{ old('name') }}" autocomplete="name" autofocus> @error('name') <span class="invalid-feedback"
                  role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" autocomplete="email" autofocus> @error('email') <span
                  class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" value="{{ old('password') }}" autocomplete="new-password" autofocus>
                @error('password') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="confirm-password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
              <div class="col-md-6">
                <input id="confirm-password" type="password" class="form-control" name="password_confirmation"
                  autocomplete="new-password"></div>
            </div>
            <!-- // for only admin -->
            <div class="form-group row">
              <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
              <div class="col-md-6">
                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                  <option value="">Choose</option>
                  <option value="0">Admin</option>
                  <option value="1">User</option>
                </select> @error('type') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
              <div class="col-md-6">
                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone"
                  value="{{ old('phone') }}" autocomplete="phone"> @error('phone') <span class="invalid-feedback"
                  role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
              <div class="col-md-6">
                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"
                  autocomplete="dob" value="{{ old('dob') }}"> @error('dob') <span class="invalid-feedback"
                  role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
              <div class="col-md-6">
                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                  style="width:100%;height:200px;resize:none" value="{{ old('address') }}"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="profile" class="col-md-4 col-form-label text-md-right">Profile</label>
              <div class="col-md-6">
                <input id="profile" type="file" class="form-control mb-3 @error('profile') is-invalid @enderror"
                  name="profile" autocomplete="profile" value="{{ old('profile') }}" onchange="loadFile(event)">
                @error('profile') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror <img src="/image/default_img.png" class="default_img" width="200"> </div>
            </div>
            <div class="form-group row mb-0 ">
              <div class="col-md-6 mx-auto">
                <button type="submit" class="btn btn-primary mr-3">{{ __('Confirm') }}</button>
                <button type="reset" class="btn btn-primary" onclick="resetimg()">{{ __('Clear') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
