<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Поиск" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     
          
           
        <li class="nav-item">
            <a href="{{ route('admin.page.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Страницы
                <span class="badge badge-info right"><!-- $posts->total() --></span>
              </p>
            </a>
             
          </li>


          <li class="nav-item">
            <a href="{{ route('admin.page.index') }}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Блог
                <span class="badge badge-info right"><!-- $posts->total() --></span>
              </p>
            </a>
             
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.mainoptioncontent.index') }}" class="nav-link">
                  <i class="fas fa-cog nav-icon"></i>
                  <p>Основные настройки</p>
             </a>
            
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.maincontent.index') }}" class="nav-link">
                <i class="fab fa-hive nav-icon"></i>
                  <p>Сквозные блоки</p>
            </a>
             
          </li>
 
         
           
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            
          </li>
          
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>