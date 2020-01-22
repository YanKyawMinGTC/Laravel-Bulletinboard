            <nav class="navbar navbar-expand-md  bg-primary shadow-sm">
              <div class="container">
                <h1 class="card-title mr-3 text-warning mt-3">SCM BULLETIN BOARD</h1> @if(Auth::user()->type==0) <a
                  class=" btn btn-primary mr-3" href="{{ route('users.index') }}">Users List</a> @endif <a
                  class=" btn btn-primary mr-3"
                  href="{{ route('users.show', Auth::user()->id) }}">{{Auth::user()->name}}'s Profile</a>
                <a class=" btn btn-primary" href="{{ route('posts.index') }}">Posts List</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">
                  </ul>
                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links --> @guest <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li> @if (Route::has('register')) <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li> @endif @else <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle text-warning" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret">
                        </span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                          {{ __('Logout') }} </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf </form>
                      </div>
                    </li> @endguest </ul>
                </div>
              </div>
            </nav>