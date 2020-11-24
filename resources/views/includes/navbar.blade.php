<!-- Header-->
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img src="{{ url('backend/images/logonew.png')}}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="{{ url('backend/images/admin.jpg')}}"
                        alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a href="{{ url('user/profile')}}"><button type="button"
                            class="btn btn-outline-secondary form-control">Profil</button></a>
                    <form action="{{ route('logout')}}" method="post">
                        @csrf
                        <button class="btn btn-secondary form-control" type="submit">Logout</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</header>