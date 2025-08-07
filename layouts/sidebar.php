  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <?php
            if (!empty($_SESSION["username"])) {
            ?>
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                      <img src="admin/<?= $admin["img_dir"]; ?>" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                      <a href="#" class="d-block"><?= $admin["nama_lengkap"]; ?></a>
                  </div>
              </div>
          <?php } ?>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="dashboard.php" class="nav-link <?php if ($menu == "Dashboard") echo "active"; ?>">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>Dashboard</p>
                      </a>
                  </li>
                  <li class="nav-header">Menu</li>
                  <li class="nav-item">
                      <a href="pengaduan.php" class="nav-link <?php if ($menu == "Data Pengaduan") echo "active"; ?>">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Data Pengaduan
                          </p>
                      </a>
                  </li>
                  <div class="nav-header">Menu Lainnya</div>
                  <li class="nav-item <?php if ($menu == "Profile") echo "menu-open"; ?>">
                      <a href="#" class="nav-link <?php if ($menu == "Profile") echo "active"; ?>">
                          <i class="nav-icon fas fa-cogs"></i>
                          <p>
                              Pengaturan
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="profile.php" class="nav-link <?php if ($menu == "Profile") echo "active"; ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Profile</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="logout.php" data-toggle="modal" data-target="#logoutModal" class="nav-link">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>