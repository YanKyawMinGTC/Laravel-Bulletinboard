@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Create Post</div>
        <div class="card-body">
          <form method="POST" action="{{route('posts.confirm_create')}}"> @csrf <div class="form-group row">
              <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
              <div class="col-md-6">
                <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title"
                  value="{{ old('title') }}" autocomplete="title" autofocus>@error('title') <span
                  class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror</div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
              <div class="col-md-6 mb-3">
                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                  name="description" autocomplete="description"
                  style="width:100%;height:200px;resize:none;"></textarea>
                @error('description') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror </div>
              <div class="col-md-6 text-center ml-5">
                <button type="submit" class="btn btn-primary mr-3">Confirm</button>
                <button type="reset" class="btn btn-primary">Clear</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
