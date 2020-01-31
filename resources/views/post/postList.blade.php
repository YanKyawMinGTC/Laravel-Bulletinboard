@extends('layouts.app') @section('content') <div class="container"> @if(Session::has('changePass-notallowed')) <div
    class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ Session::get('changePass-notallowed') }}</strong>
  </div> @endif @if($message = Session::get('success')) <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div> @endif <div class="title">
    <h2><a href="/posts">Post List</a></h2>
  </div>
  <div class="row mb-5">
    <div class="col-sm-12 col-12 col-md-6 mb-2">
      <form action="/posts/search" method="POST" role="search"> {{ csrf_field() }} <div class="input-group row">
          <input type="text" class="form-control col-8 col-md-8 col-sm-8 ml-3" name="search_keyword"
            placeholder="Search Post">
          <span class="input-group-btn col-4 col-md-4 col-sm-4">
            <button type="submit" class="btn btn-primary w-100">
              <span class="glyphicon glyphicon-search ">Search</span>
            </button>
          </span>
        </div>
      </form>
    </div>
    <div class="col-sm-3 col-12 col-md-2 mb-2">
      <a href="/post/createPost" title="post create">
        <button class="btn btn-primary w-100">Add</button>
      </a>
    </div>
    <div class="col-sm-3 col-12 col-md-2 mb-2">
      <a href="/post/uploadCsv" class="btn btn-primary w-100">Upload</a>
    </div>
    <div class="col-sm-3 col-12 col-md-2 mb-2">
      <a href="{{ route('posts.export') }}" class="btn btn-primary w-100 text-center">Download</a>
    </div>
  </div>
  <div class="table-responsive text-nowrap table-scroll">
    <table class="table table-striped main-table">
      <thead>
        <tr>
          <th>Post Title</th>
          <th colspan="3">Post Description</th>
          <th>Posted User</th>
          <th>Posted Date</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody> @if(isset($posts)) @if(isset($query))<p> The Search results for your query <b> {{ $query }} </b> are :</p>
        @foreach($posts as $po) <tr>
          <td>
            <button type="button" class="btn btn-link" data-toggle="modal" data-id="{{ $po->id }}"
              data-title="{{ $po->title }}" data-desc="{{$po->description}}" data-status="{{ $po->status }}"
              data-created_at="{{$po->created_at}}" data-created_user="{{$po->created_user}}"
              data-updated_at="{{$po->updated_at}}" data-updated_user="{{$po->updated_user}}"
              data-target="#favoritesModal">{{$po->title}}</button>
          </td>
          <td colspan="3">{{ $po->description}}</td>
          <td>{{ $po->user->name}}</td>
          <td>{{ $po->created_at}}</td>
          <td><a href="{{ route('posts.edit', $po->id) }}" class="btn btn-secondary btn-sm">Edit</a></td>
          <td>
            <form method="post" action="{{ route('posts.destroy', $po->id) }}"> @method('delete') @csrf <button
                type="submit" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr> @endforeach @elseif(!isset($query)) @foreach($posts as $po) <tr>
          <td>
            <button type="button" class="btn btn-link" data-toggle="modal" data-id="{{ $po->id }}"
              data-title="{{ $po->title }}" data-desc="{{$po->description}}" @if($po->status==0) data-status="Inactive"
              @elseif($po->status==1) data-status="Active" @endif
              data-created_at="{{date('Y/m/d', strtotime($po->created_at))}}" data-created_user="{{ $po->user->name}}"
              data-updated_at="{{date('Y/m/d', strtotime($po->updated_at))}}" data-updated_user="{{ $po->user->name}}"
              data-target="#favoritesModal">{{$po->title}}</button></td>
          <td colspan='3'>{{ $po->description}}</td>
          <td>{{$po->user->name}}</td>
          <td>{{ date('Y/m/d', strtotime($po->created_at))}}</td>
          <td><a href="{{ route('posts.edit', $po->id) }}" class="btn btn-secondary btn-sm">Edit</a></td>
          <td>
            <form method="post" action="{{ route('posts.destroy', $po->id) }}"> @method('delete') @csrf <button
                type="submit" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr> @endforeach @endif @else @if(isset($query)) <p> The Search results for your query <b> {{ $query }} </b>
          are : <tr>
            <td colspan="6"> {{$message}}</td> @elseif(!isset($query)) <td colspan="7"> {{$message}}</td>
          </tr> @endif @endif </tbody>
    </table> @if(isset($posts)) <ul class="pagination col-md-12 justify-content-center"> {{ $posts->links() }} </ul>
    @endif
  </div> @if(!isset($posts)) {{"No post found"}} @endif
</div> @endsection <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog"
  aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Post Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="modal_title" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="modal_title" disabled>
          </div>
          <div class="form-group">
            <label for="modal_desc" class="col-form-label">Description:</label>
            <textarea class="form-control" id="modal_desc" style="height:100px;resize:none;" disabled></textarea>
          </div>
          <div class="form-group">
            <label for="modal_status" class="col-form-label">Status:</label> <input class="form-control"
              id="modal_status" disabled></div>
          <div class="form-group">
            <label for="modal_created_at" class="col-form-label">Created At:</label>
            <input class="form-control" id="modal_created_at" disabled>
          </div>
          <div class="form-group">
            <label for="modal_created_user" class="col-form-label">Created User:</label>
            <input class="form-control" id="modal_created_user" disabled>
          </div>
          <div class="form-group">
            <label for="modal_updated_at" class="col-form-label">Updated At:</label>
            <input class="form-control" id="modal_updated_at" disabled>
          </div>
          <div class="form-group">
            <label for="modal_updated_user" class="col-form-label">Updated User:</label>
            <input class="form-control" id="modal_updated_user" disabled>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>