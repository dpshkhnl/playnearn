<?php include 'session.php';?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/logo.png" alt="Quick Earn" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Quick Earn</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php 
 		$str =  "SELECT * FROM admin";
  		$query = mysqli_query($link,$str);

  		$row = mysqli_fetch_assoc($query);
          echo $row['company_name'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
         
        
          <li class="nav-item">
            <a href="notification.php" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notification
                <span class="right badge badge-success">send</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cricket.php" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                 Cricket
                <span class="right badge badge-danger">Live</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cricket_activity_tracker.php" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                 Cricket Activity
                
              </p>
            </a>
          </li>
         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>