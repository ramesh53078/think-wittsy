
<div class="sidebar" data="{{@$data->sidebar_background}}">
    <div class="sidebar-wrapper">
      <div class="logo">
        <a href="javascript:void(0)" class="simple-text logo-mini">
          {{-- CT --}}
        </a>
        <a href="javascript:void(0)" class="simple-text logo-normal">
          Think Wittsy
        </a>
      </div>
      <ul class="nav">
        <li class="{{request()->routeIs('admin.dashboard') ? 'active' : ''}}">
          <a href="{{route('admin.dashboard')}}">
            <i class="tim-icons icon-chart-pie-36"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="{{request()->routeIs('admin.users.list') ? 'active' : ''}}">
          <a href="{{route('admin.users.list')}}">
            <i class="tim-icons icon-badge"></i>
            <p>Users List</p>
          </a>
        </li>

        <li class="{{request()->routeIs('admin.feedback') ? 'active' : ''}}">
          <a href="{{route('admin.feedback')}}">
            <i class="tim-icons icon-bell-55"></i>
            <p>Feedback List</p>
          </a>
        </li>
      </ul>
    </div>
  </div>