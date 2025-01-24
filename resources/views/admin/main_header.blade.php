<div class="main-header" data-background-color="purple">
    <!-- Logo Header -->
    <div class="logo-header">
        
        <a href="{{ url('/admin/dashboard') }}" class="logo d-flex justify-content-center align-items-center">
            <h3 class="text-uppercase font-weight-bold text-white" style="">
                JM International 
            </h3>
        </a>
        
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
        <div class="navbar-minimize">
            <button class="btn btn-minimize btn-rounded">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg">
        
        <div class="container-fluid">
            {{-- <div class="collapse" id="search-nav">
                <form class="navbar-left navbar-form nav-search mr-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pr-1">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Search ..." class="form-control">
                    </div>
                </form>
            </div> --}}
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                {{-- <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li> --}}


                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @php
                                $uid = Auth()->user()->id;
                                $data = App\Models\User::where('status',1)->where('id',$uid)->firstOrFail();
                            @endphp
                            @if ($data->photo != '')
                                <img src="{{ asset('uploads/users/'.$data->photo) }}" alt="Photo" class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" class="avatar-img rounded-circle">
                            @endif
                            {{-- <img src="{{asset('contents/admin')}}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle"> --}}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    @if ($data->photo != '')
                                        <img src="{{ asset('uploads/users/'.$data->photo) }}" alt="Photo" class="avatar-img rounded">
                                    @else
                                        <img src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" class="avatar-img rounded">
                                    @endif
                                    {{-- <img src="{{asset('contents/admin')}}/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"> --}}
                                </div>
                                <div class="u-text">
                                    <h4>{{ $data->name}}</h4>
                                    <p class="text-muted">
                                        @if ($data->role_id == 1)
                                            Admin
                                        @else
                                            Employee
                                        @endif
                                    </p>
                                    {{-- <a href="{{ url('/admin/profile/user_profile/'.$data->slug) }}" class="btn px-4 btn-rounded btn-secondary btn-sm">View Profile</a> --}}
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/admin/profile/user_profile/'.$data->slug) }}">
                                <i class="fas fa-user-alt"></i> &nbsp
                                My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i> &nbsp
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>