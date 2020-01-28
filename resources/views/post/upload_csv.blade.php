@extends('layouts.app') @section('content') <div class="container">
                    @if(Session::has('invalid'))
                    <div
    class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ Session::get('invalid') }}</strong>
  </div>
         @endif
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Upload CSV File</div>
        <div class="card-body">
          <form method="POST" action="{{ route('posts.import') }}" enctype="multipart/form-data"> @csrf <div class="form-group row">
              <div class="col-md-6">
                <input id="profile" type="file" class="form-control mb-3 @error('file') is-invalid @enderror" name="file">
                @error('file') <span
                  class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror
              </div>
            </div>
            <div class="form-group row mb-0 ">
              <div class="col-md-6 mx-auto">
                <button type="submit" class="btn btn-primary mr-3">Import File</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
