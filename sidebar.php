<?php session_start();
$activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
<!-- **********************************
Sidebar start
*********************************** -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link" style="background: #fff;">
      <img src="images/logo/logo.png" alt="Masstort Express Logo"  class="brand-image">
      <span class="brand-text font-weight-light">Masstort Express</span>
    </a>
    <
    <!-- Sidebar -->
    <?php if($_SESSION['role']=='admin'){ ?>
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?= ($activePage == 'dashboard') ? 'active':''; ?>">
                  <i class="nav-icon typcn typcn-device-desktop"></i>
                  <p> Dashboard </p>
                </a>
            </li>
          <li class="nav-item <?= ($activePage == 'manage_user_query' ) ? 'menu-open':''; ?>">
            <a href="#" class="nav-link <?= ($activePage == 'manage_student' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-th-list"></i>
              <p>User<i class="fas fa-angle-right right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="manage_user_query.php" class="nav-link <?= ($activePage == 'manage_user_query' || $activePage == 'view_member') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Query List</p>
                </a>
              </li>
               
            </ul>
          </li>
        
                 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <?php } ?>
    <?php if($_SESSION['role']=="manager"){ ?>
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?= ($activePage == 'dashboard') ? 'active':''; ?>">
                  <i class="nav-icon typcn typcn-device-desktop"></i>
                  <p> Dashboard </p>
                </a>
            </li>
          
           <li class="nav-item <?= ($activePage == 'add_banner' || $activePage == 'manage_banner' ) ? 'menu-open':''; ?>">
            <a href="#" class="nav-link <?= ($activePage == 'add_banner' || $activePage == 'manage_banner' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-group-outline"></i>
              <p>Banner <i class="fas fa-angle-right right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_banner.php" class="nav-link <?= ($activePage == 'add_banner') ? 'active':''; ?>"><i class="far typcn typcn-user-add-outline"></i>
                  <p>Add Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_banner.php" class="nav-link <?= ($activePage == 'manage_banner') ? 'active':''; ?>"><i class="far typcn typcn-user-add-outline"></i>
                  <p>Manage Banner</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item <?= ($activePage == 'manage_college' || $activePage == 'add_collegevisit' || $activePage == 'manage_collegevisit' ) ? 'menu-open':''; ?>">
            <a href="#" class="nav-link <?= ($activePage == 'manage_college' || $activePage == 'add_collegevisit' || $activePage == 'manage_collegevisit' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-th-list"></i>
              <p>College <i class="fas fa-angle-right right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manage_college.php" class="nav-link <?= ($activePage == 'manage_college' || $activePage == 'view_member') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Manage College List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_collegevisit.php" class="nav-link <?= ($activePage == 'add_collegevisit') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Add College Visit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_collegevisit.php" class="nav-link <?= ($activePage == 'manage_collegevisit') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Manage College Visit</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item <?= ($activePage == 'manage_student' ) ? 'menu-open':''; ?>">
            <a href="#" class="nav-link <?= ($activePage == 'manage_student' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-th-list"></i>
              <p>Student<i class="fas fa-angle-right right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="manage_student.php" class="nav-link <?= ($activePage == 'manage_student' || $activePage == 'view_member') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Manage Student List</p>
                </a>
              </li>
               
            </ul>
          </li>
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <?php } ?>
    <!-- /.sidebar -->
</aside>

