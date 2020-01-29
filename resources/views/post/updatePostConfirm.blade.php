@extends('layouts.app') @section('content') <div id="update_confirm" class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Update Post Confirm</div>
        <div class="card-body">
          <form action="{{ route('posts.update',$post_id) }}" method="post"> @csrf @method('PATCH')<div
              class="form-group row">
              <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
              <div class="col-md-6">
                <input type="title" class="form-control @error('title') is-invalid @enderror" name="title"
                  value="@if(old('title') == $posts['title']){{ old('title') }}@else {{ $posts['title'] }}@endif"
                  readonly> @error('title') <span id="title" class="invalid-feedback"
                  role="alert"><strong>{{$message}}</strong></span> @enderror </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
              <div class="col-md-6 mb-3">
                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                  name="description" style="height:200px;resize:none;" readonly>{{$posts['description']}}</textarea>
                @error('description') <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                @enderror </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
              <div class="col-md-6 ">
                  @if(isset($posts['status']))
                <label class="switch">
                  <input type="checkbox" checked readonly name="status" >
                  <span class="slider round" id="checkbox_circle" readonly></span>
                </label>
                @else
                <label class="switch" id="switch_check" readonly>
                  <input type="checkbox" name="status" readonly>
                  <span class="slider round" id="checkbox_circle" ></span>
                </label>
                @endif
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
