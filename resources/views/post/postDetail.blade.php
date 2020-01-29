@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Post Detail</div>
        <div class="col-md-12 text-center mt-5">
          <a href="/posts" class="mx-auto btn btn-primary">Go Back</a>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('posts.store')}}"> @csrf <div class="form-group row">
              <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
              <div class="col-md-6">
                <input id="title" type="title" class="form-control" name="title" value="{{$post->title}}"></div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
              <div class="col-md-6 mb-3">
                <textarea id="description" class="form-control" name="description"
                  style="width:100%;height:200px;resize:none;">{{$post->description}}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
              <div class="col-md-6 mb-3">
                <input id="status" class="form-control" name="status" value="{{$post->status}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="create_at" class="col-md-4 col-form-label text-md-right">Created At</label>
              <div class="col-md-6 mb-3">
                <input id="create_at" class="form-control" name="create_at" value="{{$post->create_at}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="created_user" class="col-md-4 col-form-label text-md-right">Created User</label>
              <div class="col-md-6 mb-3">
                <input id="created_user" class="form-control" name="created_user" value="{{$post->created_user}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="last_updated_at" class="col-md-4 col-form-label text-md-right">Last Updated At</label>
              <div class="col-md-6 mb-3">
                <input id="last_updated_at" class="form-control" name="last_updated_at"
                  value="{{$post->last_updated_at}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="updated_user" class="col-md-4 col-form-label text-md-right">Updated User</label>
              <div class="col-md-6 mb-3">
                <input id="updated_user" class="form-control" name="updated_user" value="{{$post->updated_user}}">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> @endsection