@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Change Password</div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}"> @csrf <div class="form-group row">
              <label for="oldpassword" class="col-md-4 col-form-label text-md-right">Old Password</label>
              <div class="col-md-6">
                <input id="oldpassword" type="text" class="form-control @error('oldpassword') is-invalid @enderror"
                  name="oldpassword" value="{{ old('oldpassword') }}" autocomplete="oldpassword" autofocus>
                @error('name') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="newpasssword" class="col-md-4 col-form-label text-md-right">New Password</label>
              <div class="col-md-6">
                <input id="newpasssword" type="newpasssword"
                  class="form-control @error('newpasssword') is-invalid @enderror" name="newpasssword"
                  value="{{ old('newpasssword') }}" autocomplete="newpasssword"> @error('newpasssword') <span
                  class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="con_pass" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
              <div class="col-md-6">
                <input id="con_pass" type="con_pass" class="form-control @error('con_pass') is-invalid @enderror"
                  name="con_pass" autocomplete="new-con_pass"> @error('con_pass') <span class="invalid-feedback"
                  role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
            </div>
                          <div class="form-group row mb-0 ">
                <div class="col-md-6 mx-auto">
                  <button type="submit" class="btn btn-primary mr-3">Change</button>
                  <button type="reset" class="btn btn-primary">Clear</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
