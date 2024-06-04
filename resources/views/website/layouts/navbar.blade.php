<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('/')}}">Ticket-Notification-System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li> --}}
        </ul>
        <form class="form-inline my-2 my-lg-0">
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/my-tickets') }}">My Tickets</a>
                                <div class="dropdown-divider"></div>
                                <form id="logout-form" action="{{ route('logout-user') }}" method="POST">
                                    @csrf
                                    <a href="{{ route('logout-user') }}" class="dropdown-item">
                                            Logout
                                    </a>
                                </form>

                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-info btn-sm">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </form>
    </div>
</nav>

<!-- Include Bootstrap JS -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
