<div class="sidebar">
			
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    {{-- @php
                        $uid = Auth()->user()->id;
                        $data = App\Models\User::where('status',1)->where('id',$uid)->firstOrFail();
                    @endphp --}}
                    {{-- @if ($data->photo != '')
                        <img src="{{ asset('uploads/users/'.$data->photo) }}" alt="Photo" class="avatar-img rounded-circle">
                    @else
                        <img src="{{ asset('uploads/users/avarter.jpg') }}" alt="Photo" class="avatar-img rounded-circle">
                    @endif --}}
                    <img src="{{asset('contents/admin')}}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">
                                @if (Auth::user()->role_id == 1)
                                <span class="badge badge-success px-4">
                                    {{-- {{ $data->user_role->role_name }} --}} Admin 
                                </span>
                                @endif
                            </span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">NAVBAR</h4>
                </li>
                {{-- @if (Auth::user()->role_id == 1) --}}
                <li class="nav-item {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }} ">
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(2) == 'profile') ? 'active' : '' }}">
                    <a href="{{ url('/admin/profile/user_profile/'.Auth::user()->slug) }}">
                        <i class="fas fa-user-alt"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(2) == 'customers') ? 'active' : '' }}">
                    <a href="{{ url('/admin/customers') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(2) == 'users') ? 'active' : '' }}">
                    <a href="{{ url('/admin/users') }}">
                        <i class="fas fa-address-book"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(2) == 'products') ? 'active' : '' }}">
                    <a href="{{ url('/admin/products') }}">
                        <i class="fas fa-hospital"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(2) == 'orders') ? 'active' : '' }}">
                    <a href="{{ url('/admin/orders') }}">
                        <i class="fas fa-laptop"></i>
                        <p>Cashier</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(2) == 'reports') ? 'active' : '' }}">
                    <a href="{{ url('/admin/reports') }}">
                        <i class="fas fa-file"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(2) == 'transactions') ? 'active' : '' }}">
                    <a href="{{ url('/admin/transactions') }}">
                        <i class="fas fa-money-bill-alt"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->segment(2) == 'suppliers') ? 'active' : '' }}">
                    <a href="{{ url('/admin/suppliers') }}">
                        <i class="fas fa-shipping-fast"></i>
                        <p>Suppliers</p>
                    </a>
                </li>
                
                <li class="nav-item {{ (request()->segment(2) == 'restore') ? 'active' : '' }}">
                    <a href="{{ url('/admin/restore') }}">
                        <i class="fas fa-recycle"></i>
                        <p>Restore</p>
                    </a>
                </li>

                {{-- @else --}}
                {{-- {{ (request()->segment(2) == 'orders') ? 'active' : '' }} --}}
                
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i>
                        <p class="text-danger">Logout</p>
                    </a>
                </li>
                {{-- @endif --}}

            </ul>
        </div>
    </div>
</div>