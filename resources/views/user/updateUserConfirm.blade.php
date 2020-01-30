@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 col-sm-12">
      <div class="card">
        <div class="card-header">Update User Confirm</div>
        <div class="row">
          <div class="card-body col-md-12 col-sm-12">
            <form method="POST" action="{{ route('users.update',$user_id) }}"> @csrf @method('PATCH') <div
                class="w-25 m-auto"> @if(!file_exists(public_path()."/profile_img/{{$user_id}}/image/{{$file_name}}"))
                <input type="text" name="profile" value="{{$file_name}}" hidden>
                <img src="/profile_img/{{$user_id}}/image/{{$file_name}}" alt="{{$file_name}}" class="w-100 m-auto">
                @else <input type="text" name="profile" value="{{$file_name}}" hidden>
                <img src="/image/default_img.png" alt="default_img" class="w-100 m-auto"> @endif </div>
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="{{$user_detail['name']}}"
                    readonly></div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="{{$user_detail['email']}}"
                    autocomplete="email" readonly></div>
              </div>
              <!-- // for only admin -->
              <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="type"
                    value="@if($user_detail['type']==0)Admin @else User @endif" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6">
                  <input id="phone" type="phone" class="form-control" name="phone" value="{{$user_detail['phone']}}"
                    autocomplete="phone" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                <div class="col-md-6">
                  <input id="dob" type="date" class="form-control" name="dob" value="{{$user_detail['dob']}}"
                    autocomplete="dob" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-6">
                  <textarea name="address" id="address" class="form-control" style="width:100%;height:200px;resize:none"
                    readonly>{{$user_detail['address']}}</textarea>
                </div>
              </div>
              <div class="form-group row mb-0 ">
                <div class="col-md-6 mx-auto">
                  <button type="submit" class="btn btn-primary mr-3">Update</button>
                  <a href="{{ route('users.edit', Auth::user()->id)}}" class="btn btn-primary">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
