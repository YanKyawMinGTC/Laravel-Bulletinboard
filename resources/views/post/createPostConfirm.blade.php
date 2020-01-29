@extends('layouts.app') @section('content') <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create Post Confirm</div>
        <div class="card-body">
             <form method="POST" action="{{route('posts.store')}}"> @csrf <div class="form-group row">
              <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
              <div class="col-md-6 d-flex">
                <input id="title" type="title" class="form-control" name="title"
                  value="{{$posts['title']}}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
              <div class="col-md-6 d-flex mb-3">
                <textarea id="description" class="form-control" name="description" style="height:200px;resize:none;"
                  readonly>{{$posts['description']}}</textarea>
              </div>
              <div class="col-md-12 col-10 text-center ml-5">
                <button type="submit" class="btn btn-primary mr-3">Create</button>
                <button type="submit" class="btn btn-primary">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
