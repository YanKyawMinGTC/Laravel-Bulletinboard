            <nav class="navbar navbar-expand-md  bg-primary shadow-sm">
              <div class="container">
                <h1 class="card-title mr-3 text-warning mt-3">SCM BULLETIN BOARD</h1> @if(Auth::user()->type==0) <div
                  class="row">
                  <a class="btn btn-primary mr-3 " href="{{ route('users.index') }}">Users List</a> @endif <a
                    class=" btn btn-primary mr-3"
                    href="{{ route('users.show', Auth::user()->id) }}">{{Auth::user()->name}}'s Profile</a>
                  <a class=" btn btn-primary" href="{{ route('posts.index') }}">Posts List</a>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-link">
                      <p class="text-light nav-item mt-2"> {{ Auth::user()->name }}</p>
                    </li>
                    <li class="nav-link"> <a class="text-light btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }} </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style=""> @csrf </form>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>