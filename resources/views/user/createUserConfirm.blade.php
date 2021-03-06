@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Create User Confirm</div>
        <div class="row">
          <div class="card-body col-md-12">
            <form method="POST" action="{{ route('users.store') }}"> @csrf <div class="row">
                <div class="form-group col-md-4 right">
                  <div class="mt-5 form-group"> @if(!file_exists("/profile_img/{{$user_id}}/image/{{$file_name}}"))
                    <input type="text" name="profile" value="{{$file_name}}" hidden>
                    <div class=" w-50 m-auto ">
                      <img src="/profile_img/{{$user_id}}/image/{{$file_name}}" alt="{{$file_name}}" class="w-100">
                    </div> @else <input type="text" name="profile" value="default_img.png" hidden>
                    <img src="/image/default_img.png" alt="default_img" class="w-50"> @endif
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                    <div class="col-md-6 col-10">
                      <input id="name" type="text" class="form-control" name="name" value="{{$user_detail['name']}}"
                        readonly></div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                    <div class="col-md-6 col-10">
                      <input id="email" type="email" class="form-control" name="email" value="{{$user_detail['email']}}"
                        readonly></div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6 col-10">
                      <input id="password" type="password" class="form-control" name="password"
                        value="{{$user_detail['password']}}" readonly>
                    </div>
                  </div>
                  <!-- // for only admin -->
                  <div class="form-group row">
                    <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                    <div class="col-md-6 col-10">
                      <input type="text" name="type" id="type"
                        value="@if($user_detail['type']==0)Admin @else User @endif" class="p-2 form-control" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                    <div class="col-md-6 col-10">
                      <input id="phone" type="phone" class="form-control" name="phone" value="{{$user_detail['phone']}}"
                        readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                    <div class="col-md-6 col-10">
                      <input id="dob" type="text" class="form-control" name="dob"
                        value="{{date('Y/m/d', strtotime($user_detail['dob']))}}" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                    <div class="col-md-6 col-10">
                      <textarea name="address" id="address" class="form-control"
                        style="width:100%;height:100px;resize:none" readonly>{{$user_detail['address']}}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12 col-10 mt-3 text-center">
                    <button type="submit" class="btn btn-primary mr-3">Create</button>
                    <a href="/users" class="btn btn-primary">Cancel</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection