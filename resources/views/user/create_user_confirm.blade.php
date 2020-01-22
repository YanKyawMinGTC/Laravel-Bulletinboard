@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Create User Confirm</div>
        <div class="row">
          <div class="card-body col-md-8">
            <form method="POST" action="{{ route('register') }}"> @csrf <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" disabled></div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" disabled></div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" value="**********" disabled>
                </div>
              </div>
              <!-- // for only admin -->
              <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                <div class="col-md-6">
                  <input type="text" name="type" id="type" value="Admin" class="p-2 form-control" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6">
                  <input id="phone" type="phone" class="form-control" name="phone" value="09234234" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="dob" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                <div class="col-md-6">
                  <input id="dob" type="date" class="form-control" name="dob" value="2013/24/21" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-6">
                  <textarea name="address" id="address" class="form-control" style="width:100%;height:100px;resize:none"
                    disabled>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore fuga porro laudantium consequatur recusandae perferendis aut. Officiis quisquam, debitis commodi sapiente et mollitia ab consequuntur perferendis similique nam atque magni.</textarea>
                </div>
              </div>
              <div class="form-group row mb-0 ">
                <div class="col-md-6 mx-auto">
                  <button type="submit" class="btn btn-primary mr-3">Create</button>
                  <button type="reset" class="btn btn-primary">Cancel</button>
                </div>
              </div>
            </form>
          </div>
          <div class="form-group col-md-4">
            <div class="mt-5">
              <img src="/image/default_img.png" alt="dog img" class="w-50 rounded-circle">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection