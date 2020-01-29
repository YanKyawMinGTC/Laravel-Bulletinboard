@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">User Profile</div> @if (Auth::user()->id == $user_prof['id']) <div
          class="d-inline-flex justify-content-center mt-5 mb-5">
          <a href="{{ route('users.edit', Auth::user()->id) }}" class="text-center btn btn-primary">Edit</a>
        </div> @endif <div class="row">
          <div class="card-body col-md-8">
            <form method="POST" action="{{ route('register') }}"> @csrf <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control " name="name" value="{{$user_prof['name']}}"
                    readonly></div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="{{$user_prof['email']}}"
                    readonly></div>
              </div>
              <!-- // for only admin -->
              <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                <div class="col-md-6"> @if($user_prof['type']== 0) <input type="text" name="type" id="type"
                    value="Admin" class="p-2 form-control" readonly> @else <input type="text" name="type" id="type"
                    value="User" class="p-2 form-control" readonly> @endif </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6">
                  <input id="phone" type="phone" class="form-control" name="phone" value="{{$user_prof['phone']}}"
                    readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                <div class="col-md-6">
                  <input id="dob" type="text" class="form-control" name="dob" value="{{date('Y/m/d', strtotime($user_prof['dob']))}}" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-6">
                  <textarea name="address" id="address" style="width:100%;height:100px;resize:none" class="form-control"
                    readonly>{{$user_prof['address']}}</textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="form-group col-md-4">
            <div class="mt-5">
            @if(!file_exists("/profile_img/{{$user_prof->id}}/image/{{$user_prof->profile}}"))
              <img src="/profile_img/{{$user_prof->id}}/image/{{$user_prof->profile}}"
                alt="{{$user_prof->profile}}" class="w-50">
                @else
                <img src="/image/default_img.png" alt="default_img" class="w-50">
                  @endif
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
