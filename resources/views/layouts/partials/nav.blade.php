<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
      @auth()
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="{{route('dashboard.profile.edit')}}" class="d-block mb-4">{{auth()->guard('admin')->user()->name}}</a>
                    <form action="{{route('logout')}}" method="post" >
                        @csrf

                        <button type="submit" class="btn btn-outline-primary">logout</button>
                    </form>
                </div>
            </div>
        @endauth

        <!-- SidebarSearch Form -->

        <x-nav/>
    </div>
    <!-- /.sidebar -->
</aside>
