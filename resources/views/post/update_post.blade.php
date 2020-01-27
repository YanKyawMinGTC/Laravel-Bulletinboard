@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Update Post</div>
        <div class="card-body">
          <form action="{{ route('posts.confirm_update') }}" method="post"> @csrf 
            
              <input type="text" name="id" value="{{$post->id}}" hidden>
        
            <div
              class="form-group row">
              <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
              <div class="col-md-6">
                <input type="title" class="form-control @error('title') is-invalid @enderror" name="title"
                  value="@if(old('title') == $post->title){{ old('title') }}@else {{ $post->title }}@endif">
                @error('title') <span id="title" class="invalid-feedback"
                  role="alert"><strong>{{$message}}</strong></span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
              <div class="col-md-6 mb-3">
                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                  name="description" style="height:200px;resize:none;">{{$post->description}}</textarea>
                @error('description') <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                @enderror </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
              <div class="col-md-6 ">
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-md-6 text-center ml-5">
              <button type="submit" class="btn btn-primary mr-3">Create</button>
              <button type="reset" class="btn btn-primary">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
