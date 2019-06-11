<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>W</b>HM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Warehouse</b>Manage</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Chamal Amarakoon</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Buddhika Herath
                  <small>Member since Nov. 2021</small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Buddhika</p>
          
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Suppliers Management</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./addsuppliers.php"><i class="fa fa-circle-o"></i>Add suppliers</a></li>
            <li><a href="./viewsupplier.php"><i class="fa fa-circle-o"></i>View Allusers </a></li>
           </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Put Orders to supplier</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./makeorders.php"><i class="fa fa-circle-o"></i>Make orders</a></li>
            <li><a href="./orderconfrimation.php"><i class="fa fa-circle-o"></i>Order confirmation</a></li>
                               </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Products Managment</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./addproducts.php"><i class="fa fa-circle-o"></i>Add Products</a></li>
            <li><a href="./viewproducts.php"><i class="fa fa-circle-o"></i>View Products</a></li>
          
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Order Management</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="./assets/php/ihandeljson.php?get_orders=1"><i class="fa fa-circle-o"></i>GET ORDER FROM SALES</a></li>
            <li><a href="./recived_items.php"><i class="fa fa-circle-o">Make Order As Recervied</i></a></li>
            <li><a href="./recerved_orders.php"><i class="fa fa-circle-o">Confrim/Cance</i></a></li>
          
          </ul>
        </li>
        
       
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>