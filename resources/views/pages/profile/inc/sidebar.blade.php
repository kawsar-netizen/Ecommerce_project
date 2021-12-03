<div class="card" style="width: 18rem;">
        <img src="" class="card-img-top" height="100%" width="100%" alt="card-img-cap">
            <ul class="list-group list-group-flush">
            <a href="{{route('home')}}" class="btn btn-primary btn-sm btn-block">Home</a>
            <a href="{{route('user.order')}}" class="btn btn-primary btn-sm btn-block">My Orders</a>
            <a  class="btn btn-danger btn-sm btn-block" href="{{ route('logout')}}" onclick="return confirm('Are You Sure To Delete?')"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
            </ul>
        </div>