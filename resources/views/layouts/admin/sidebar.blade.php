<ul class="nav">
  <li class="nav-item nav-profile">
    <a href="#" class="nav-link">
      <div class="nav-profile-image">
        <img src="{{ asset('admin/images/faces/face1.jpg')}}" alt="profile" />
        <span class="login-status online"></span>
        <!--change to offline or busy as needed-->
      </div>
      <div class="nav-profile-text d-flex flex-column">
        <span class="font-weight-bold mb-2">David Grey. H</span>
        <span class="text-secondary text-small">Project Manager</span>
      </div>
      <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.beranda') }}">
      <span class="menu-title">Dashboard</span>
      <i class="mdi mdi-home menu-icon"></i>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-title">Manajemen</span>
      <i class="menu-arrow"></i>
      <i class="mdi mdi-crosshairs-gps menu-icon"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.produk.index') }}">
            Produk
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.kategori.index')}}">Kategori</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{  route('admin.member.index') }}">Member</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{  route('admin.kasir.index') }}">Kasir</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.produk_masuk.index') }}">Produk Masuk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.produk_keluar.index')}}">Produk Keluar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.pemasok.index')}}">Supplier</a>
        </li>
      </ul>
    </div>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="{{  route('admin.laporan.index') }}">
      <span class="menu-title">Laporan</span>
      <i class="mdi mdi-book menu-icon"></i>
    </a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ route('action-logout') }}">
      <span class="menu-title">Sign out</span>
      <i class="mdi mdi-home menu-icon"></i>
    </a>
  </li>
</ul>
