<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/img/Legal.png') }}" style="width: 70%; margin-top: 5px"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('dashboard') }}">LG</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header" style="margin-top: 20px">Dashboard</li>
        <li><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

        @if (auth()->user()->role == "Admin" || auth()->user()->role == "Legal")
            <li class="menu-header">Perizinan</li>
            <li><a class="nav-link" href="{{ route('izinCorporate') }}"><i class="far fa-file-alt"></i><span>Izin Corporate</span></a></li>
            <li><a class="nav-link" href="{{ route('izinNakes') }}"><i class="far fa-file-alt"></i><span>Izin Nakes</span></a></li>
            <li><a class="nav-link" href="{{ route('agreement') }}"><i class="far fa-file-alt"></i><span>Agreements</span></a></li>
        @endif

        <li class="menu-header">Template Surat</li>
        <li><a class="nav-link" href="{{ route('template') }}"><i class="far fa-file-alt"></i><span>Template</span></a></li>

        @if (auth()->user()->role == "Admin" || auth()->user()->role == "Legal")
            <li class="menu-header">Master Data</li>
            <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Utilities</span></a>
            <ul class="dropdown-menu" >
                <li><a class="nav-link" href="{{ route('unit') }}">Unit</a></li>
                <li><a class="nav-link" href="{{ route('employee') }}">Employees</a></li>
                <li><a class="nav-link" href="{{ route('department') }}">Department</a></li>
                <li><a class="nav-link" href="{{ route('penerbit.index') }}">Penerbit</a></li>
                <li><a class="nav-link" href="{{ route('counter') }}">Counter</a></li>
                <li><a class="nav-link" href="{{ route('category') }}">Categories</a></li>
            </ul>
            </li>
        @endif 

        @if (auth()->user()->role == "Admin")
            <li class="menu-header">Settings</li>
            <li><a class="nav-link" href="{{ route('settings') }}"><i class="fas fa-tools"></i><span>Users</span></a></li>
        @endif
    </ul>
  </aside>