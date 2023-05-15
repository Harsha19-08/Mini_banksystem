 <?php
 $active_str = '';
$all_page_uri = $_SERVER['REQUEST_URI'];
// echo "<pre>";
 //print_r($all_page_uri);
$all_page_arr = explode("/", $all_page_uri);
// print_r($all_page_arr);
$all_page_active = explode('.',$all_page_arr[2]);
//print_r($all_page_active);
$all_page_active = $all_page_active[0];
error_reporting(0);
if(in_array($all_page_active,['index','add_users','list_users'])){
 echo  $active_str = 'active';
}

?> 
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link"> 
      <span class="brand-text font-weight-dark">Mini Bank Management</span>
    </a>
      <!-- Sidebar Menu -->
      <nav class="mt-2" style="overflow-x: scroll;height: 660px;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link <?php if($all_page_active == 'index')echo $active_str;?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          
          
          <li class="nav-item has-treeview <?php if($all_page_active == 'add_users' || $all_page_active == 'list_users') echo "menu-open" ?>">
            <a href="" class="nav-link   <?php if($all_page_active == 'add_users' || $all_page_active == 'list_users') echo $active_str ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Account Holders
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
         
            <ul class="nav nav-treeview">
            <?php if($_SESSION['type'] == 1): ?>
              <li class="nav-item">
                <a href="add_users.php"  class="nav-link <?php if($all_page_active == 'add_users') echo $active_str; ?>">
                  <i class="far fa-circle nav-icon"></i>
                <p>Add New </p>
                </a>
              </li>
              <?php endif; ?>
              <li class="nav-item">
                <a href="list_users.php" class="nav-link <?php if($all_page_active == 'list_users') echo $active_str; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Users</p>
                </a>
              </li>
            </ul>
           
          </li>
          
          <li class="nav-item has-treeview <?php if($all_page_active == 'add_money' || $all_page_active == 'withdraw_money') echo "menu-open" ?>">
            <a href="" class="nav-link   <?php if($all_page_active == 'add_money' || $all_page_active == 'withdraw_money') echo $active_str ?>">
              <i class="nav-icon fas fa-tag"></i>
              <p>
              Banking
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
         
            <ul class="nav nav-treeview">
            <?php if($_SESSION['type'] == 1): ?>
              <li class="nav-item">
                <a href="add_money.php"  class="nav-link <?php if($all_page_active == 'add_money') echo $active_str; ?>">
                  <i class="far fa-circle nav-icon"></i>
                <p>Add Money </p>
                </a>
              </li>
              <?php endif; ?>
              <li class="nav-item">
                <a href="withdraw_money.php" class="nav-link <?php if($all_page_active == 'withdraw_money') echo $active_str; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Withdraw</p>
                </a>
              </li>
            </ul>
           
          </li>
        </ul>
      </nav>
  </aside>
