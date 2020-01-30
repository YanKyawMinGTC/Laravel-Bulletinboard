@extends('layouts.app') @section('content') <div class="container"> @if(count($errors) > 0) <div
    class="alert alert-danger"> Upload Validation Error<br><br>
    <ul> @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
  </div> @endif @if(session('success')) <div class="alert alert-success" role="alert">
    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><strong>SUCCESS</strong> &nbsp;
    {{ session()->get('message')}}</div> @endif <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Change Password</div>
        <div class="card-body">
          <form method="put" action="/changePwd/{{auth()->user()->id}}"> @csrf <div class="form-group row">
              <label for="oldpassword" class="col-md-4 col-form-label text-md-right">Old Password</label>
              <div class="col-md-6">
                <input id="oldpassword" type="password" class="form-control @error('old_password') is-invalid @enderror"
                  name="old_password" value="{{ old('old_password') }}" autocomplete="old_password" autofocus>
                @error('old_password') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
                 <label class="col-md-1 col-form-label text-md-left text-danger">*</label>
            </div>
            <div class="form-group row">
              <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password</label>
              <div class="col-md-6">
                <input id="new_password" type="password"
                  class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                  value="{{ old('new_password') }}" autocomplete="new_password"> @error('new_password') <span
                  class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
                 <label class="col-md-1 col-form-label text-md-left text-danger">*</label>
            </div>
            <div class="form-group row">
              <label for="confirm-password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
              <div class="col-md-6">
                <input id="confirm-password" type="password" class="form-control" name="password_confirmation"
                  autocomplete="new-password"></div>
                   <label class="col-md-1 col-form-label text-md-left text-danger">*</label>
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
