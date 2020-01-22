@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">User Profile</div>
          @if (auth()->user()->type == 1)
        <div class="d-inline-flex justify-content-center mt-5 mb-5">
          <a href="{{ route('users.edit', Auth::user()->id) }}" class="text-center btn btn-primary">Edit</a>
        </div>
        @endif
        <div class="row">
          <div class="card-body col-md-8">
            <form method="POST" action="{{ route('register') }}"> @csrf <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control " name="name" value="{{$user_prof['name']}}"
                   disabled></div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email"
                    value="{{$user_prof['email']}}" disabled></div>
              </div>
              <!-- // for only admin -->
              <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                <div class="col-md-6">
                @if($user_prof['type']== 0)
                  <input type="text" name="type" id="type" value="Admin" class="p-2 form-control" disabled>
                  @else
                  <input type="text" name="type" id="type" value="User" class="p-2 form-control" disabled>
                @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6">
                  <input id="phone" type="phone" class="form-control" name="phone" value="{{$user_prof['phone']}}" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                <div class="col-md-6">
                  <input id="dob" type="date" class="form-control" name="dob" value="{{$user_prof['dob']}}" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-6">
                  <textarea name="address" id="address"
                    style="width:100%;height:100px;resize:none" class="form-control" disabled>{{$user_prof['address']}}</textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="form-group col-md-4">
            <div class="mt-5">
              <img src="/image/download.jpg" alt="dog img" class="w-50 ">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
