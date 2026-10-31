<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ url('admin/dashboard')}}">HIMASI UNUSA</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('admin/dashboard')}}">
        @if ($profiles->logo)
          <img src="{{ Storage::url($profiles->logo) }}" width="30" alt="Logo" class="">
        @endif
      </a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
          <a href="{{ url('admin/dashboard')}}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Menu</li>
        <li class="nav-item {{ Request::is('admin/program-kerja') ? 'active' : '' }}">
          <a href="{{ url('admin/program-kerja')}}" class="nav-link"><i class="fas fa-briefcase"></i><span>Program Kerja</span></a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="nav-item {{ Request::is('admin/agenda') ? 'active' : '' }}">
          <a href="{{ url('admin/agenda')}}" class="nav-link"><i class="fas fa-info-circle"></i><span>Informasi Kegiatan</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/profile/1') ? 'active' : '' }}">
          <a href="{{ url('admin/profile/1')}}" class="nav-link"><i class="fas fa-building"></i><span>Profil Organisasi</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/home-background') ? 'active' : '' }}">
          <a href="{{ route('home-background.index') }}" class="nav-link"><i class="fas fa-images"></i><span>Foto Latar Beranda</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/divisi') ? 'active' : '' }}">
          <a href="{{ url('admin/divisi')}}" class="nav-link"><i class="fas fa-th"></i><span>Divisi</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/member-divisi') ? 'active' : '' }}">
          <a href="{{ url('admin/member-divisi')}}" class="nav-link"><i class="fas fa-users"></i><span>Anggota Divisi</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/berita') ? 'active' : '' }}">
          <a href="{{ url('admin/berita')}}" class="nav-link"><i class="fas fa-newspaper"></i><span>Artikel</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/galeri') ? 'active' : '' }}">
          <a href="{{ url('admin/galeri')}}" class="nav-link"><i class="fas fa-image"></i><span>Galeri</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
          <a href="{{ url('admin/users')}}" class="nav-link"><i class="fas fa-users-cog"></i><span>Users</span></a>
        </li>
        @endif
      
        <div class="px-3 " style="margin-top: 20px; margin-bottom: 20px">
          <form action="{{ url ('logout')}}" method="POST">
          @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm btn-block ">
              <i class="fas fa-sign-out-alt"></i> <span class="hide-sidebar-mini">Logout</span>
            </button>
          </form>
        </div>
      </ul>
  </aside>
</div>