            <nav class="navbar navbar-expand-md navbar-light bg-primary">
              <a href="{{route('posts.index')}}" class="pr-1">
                <h1 class="card-title text-warning ">SCM BULLETIN BOARD</h1>
              </a>
              <button type="button" class="navbar-toggler ml-auto" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav"> @if(Auth::user()->type==0) <a href="{{ route('users.index') }}"
                    class="nav-item nav-link btn btn-primary text-light">User List</a> @endif <a
                    href="{{ route('users.show', Auth::user()->id) }}"
                    class="nav-item nav-link btn btn-primary text-light">{{Auth::user()->name}}'s Profile</a>
                  <a href="{{ route('posts.index') }}" class="nav-item nav-link btn btn-primary text-light">Posts
                    List</a>
                </div>
                <div class="navbar-nav ml-auto">
                  <span class="nav-item nav-link m-auto text-light">{{ Auth::user()->name }}</span>
                  <a href="{{ route('logout') }}" class="nav-item nav-link btn btn-primary text-light"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style=""> @csrf </form>
                </div>
              </div>
            </nav>
