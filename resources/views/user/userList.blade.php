 @extends('layouts.app') @section('content') <div class="container">
   <div class="title">
     <h2><a href="/users">User List</a></h2>
   </div>
   <div class="row mb-5">
     <form action="/users/search" method="POST" role="search"> {{ csrf_field() }} <div class="input-group row m-auto">
         <div class="col-sm-6 col-12 col-md-2 mb-2">
           <input type="text" class="form-control w-100 p-1" name="name" placeholder="Enter Name">
         </div>
         <div class="col-sm-6 col-12 col-md-2 mb-2">
           <input type="text" class="form-control w-100 p-1" name="email" placeholder="Enter Email">
         </div>
         <div class="col-sm-6 col-12 col-md-2 mb-2">
           <input type="date" class="form-control w-100 p-1" name="created_from" placeholder="Created From">
         </div>
         <div class="col-sm-6 col-12 col-md-2 mb-2">
           <input type="date" class="form-control w-100 p-1" name="created_to" placeholder="Created To">
         </div>
         <div class="col-sm-6 col-12 col-md-2 mb-2">
           <button type="submit" class="form-control btn btn-primary w-100">Search</button>
         </div>
         <div class="col-sm-6 col-12 col-md-2 mb-2">
           <a href="/user/createUser" title="user create" class="form-control btn btn-primary  w-100"> Add </a>
         </div>
     </form>
   </div> @if(session('error')) <div class="alert alert-danger" role="alert"> {{ session('error')}} </div> @endif <div
     class="container">
     <div class="table-responsive text-nowrap">
       <table class="table table-hover table-fixed">
         <thead>
           <tr>
             <th scope="col">ID</th>
             <th scope="col">Name</th>
             <th scope="col">Email</th>
             <th scope="col">Created User</th>
             <th scope="col">Phone</th>
             <th scope="col">Birth Date</th>
             <th scope="col">Creatd Date</th>
             <th scope="col">Delete</th>
           </tr>
         </thead>
         <tbody> @if(isset($users)) @if(isset($query))<p> The Search results for your query <b> {{ $query }} </b> are :
           </p> @foreach($users as $user) <tr>
             <td>{{$user->id}}</td>
             <td>
               <button type="button" class="btn btn-link" data-toggle="modal" data-id="{{ $user->id }}"
                 data-name="{{ $user->name }}" data-email="{{$user->email}}" data-phone="{{ $user->phone }}"
                 data-dob="{{date('Y/m/d', strtotime($user->dob))}}" data-address="{{$user->address}}"
                 data-created_at="{{$user->created_at}}" data-created_user="{{$user->created_user_name}}"
                 data-updated_at="{{$user->updated_at}}" data-updated_user="{{$user->updated_user}}"
                 data-target="#userModal">{{$user->name}}</button>
             </td>
             <td>{{$user->email}}</td>
             <td>{{$user->created_user_name}}</td>
             <td>{{$user->phone}}</td>
             <td>{{date('Y/m/d', strtotime($user->dob))}}</td>
             <td>{{date('Y/m/d', strtotime($user->created_at))}}</td>
             <td>
               <form method="post" action="{{ route('users.destroy', $user->id) }}"> @method('delete') @csrf <button
                   type="submit" onclick="return confirm('Are you sure?');"
                   class="btn btn-danger btn-sm">Delete</button>
               </form>
             </td>
           </tr> @endforeach @elseif(!isset($query)) @foreach($users as $user) <tr>
             <td>{{$user->id}}</td>
             <td>
               <button type="button" class="btn btn-link" data-toggle="modal" data-id="{{ $user->id }}"
                 data-name="{{ $user->name }}" data-email="{{$user->email}}" data-phone="{{ $user->phone }}"
                 data-dob="{{date('Y/m/d', strtotime($user->dob))}}" data-address="{{$user->address}}"
                 data-created_at="{{$user->created_at}}" data-created_user="{{$user->created_user_name}}"
                 data-updated_at="{{$user->updated_at}}" data-updated_user="{{$user->updated_user}}"
                 data-target="#userModal">{{$user->name}}</button>
             </td>
             <td>{{$user->email}}</td>
             <td>{{$user->created_user_name}}</td>
             <td>{{$user->phone}}</td>
             <td>{{date('Y/m/d', strtotime($user->dob))}}</td>
             <td>{{date('Y/m/d', strtotime($user->created_at))}}</td>
             <td>
               <form method="post" action="{{ route('users.destroy', $user->id) }}"> @method('delete') @csrf <button
                   type="submit" onclick="return confirm('Are you sure?');"
                   class="btn btn-danger btn-sm">Delete</button>
               </form>
             </td>
           </tr> @endforeach @endif @else @if(isset($query)) <p> The Search results for your query <b> {{ $query }} </b>
             are : <td colspan="7"> {{$message}}</td> @elseif(!isset($query)) <td colspan="7"> {{$message}}</td> @endif
             @endif </tbody>
       </table>
     </div>
   </div>
   <ul class="pagination col-md-12 justify-content-center"> {{ $users->links()}} </ul>
 </div> @endsection <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">User Detail</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <form>
           <div class="form-group">
             <label for="modal_name" class="col-form-label">Name:</label>
             <input type="text" class="form-control" id="modal_name" disabled>
           </div>
           <div class="form-group">
             <label for="modal_email" class="col-form-label">Email:</label>
             <input type="email" class="form-control" id="modal_email" disabled>
           </div>
           <div class="form-group">
             <label for="modal_phone" class="col-form-label">Phone:</label>
             <input type="text" class="form-control" id="modal_phone" disabled>
           </div>
           <div class="form-group">
             <label for="modal_dob" class="col-form-label">Birth Date:</label>
             <input type="text" class="form-control" id="modal_dob" disabled>
           </div>
           <div class="form-group">
             <label for="modal_address" class="col-form-label">Address:</label>
             <input type="text" class="form-control" id="modal_address" disabled>
           </div>
           <div class="form-group">
             <label for="modal_created_at" class="col-form-label">Created At:</label>
             <input type="text" class="form-control" id="modal_created_at" disabled>
           </div>
           <div class="form-group">
             <label for="modal_created_user" class="col-form-label">Created User:</label>
             <input type="text" class="form-control" id="modal_created_user" disabled>
           </div>
           <div class="form-group">
             <label for="modal_updated_at" class="col-form-label">Last Updated At:</label>
             <input type="text" class="form-control" id="modal_updated_at" disabled>
           </div>
           <div class="form-group">
             <label for="modal_updated_user" class="col-form-label">Last Updated User:</label>
             <input type="text" class="form-control" id="modal_updated_user" disabled>
           </div>
         </form>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>
