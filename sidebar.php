<?php
//include 'connection.php';

// $connection = mysqli_connect('localhost:8080', 'root', '', 'ticket_management_system');

$user_id=$_SESSION['PFC_UID'];

//echo $user_id;
?>
<aside class="left-sidebar" style="background: cornflowerblue;">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
              </li>
              <?php if($_SESSION['PFC_UID']==1){?>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Manage User</span></a>
                  <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="add_user.php" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu">Add User</span></a>
                  </li>
                  <li class="sidebar-item">
                    <a href="view_user.php" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu">View User</span></a>
                  </li>
                  <li class="sidebar-item">
                    <a href="user_gp_level.php" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu">Emp Details</span></a>
                  </li>
                  <?php } ?>
                  <!-- <li class="sidebar-item">
                    <a href="role_assign.php" class="sidebar-link"
                      ><i class="mdi mdi-all-inclusive"></i
                      ><span class="hide-menu">Role User</span></a
                    >
                  </li> -->
                
                </ul>
               
              </li>
              <!-- <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="DHQ.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-chart-bubble"></i
                  ><span class="hide-menu">DHQ</span></a
                >
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="SHQ.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-border-inside"></i
                  ><span class="hide-menu">SHQ</span></a
                >
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="BHQ.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-blur-linear"></i
                  ><span class="hide-menu">BHQ</span></a
                >
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="GP.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-blur-linear"></i
                  ><span class="hide-menu">GP</span></a
                >
              </li> -->
              <ul id="sidebarnav">
              <li class="sidebar-item">
              <?php
        // Fetch data from the 'roles' table.
        $query = "SELECT * FROM `roles` where user_id='$user_id'";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Iterate through each role
            while ($row = mysqli_fetch_assoc($result)) {
                $sites = explode(',', $row["role_name"]);

                // Check conditions for each role_name
                if ($row["user_id"] == $user_id && $row["permission"] == 1) {
                    foreach ($sites as $site) {
                        // Check each individual role_name
                        if ($site == 'DHQ') {
                            echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="DHQ.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">DHQ</span></a>';
                        } elseif ($site == 'SHQ') {
                            echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="SHQ.php" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">SHQ</span></a>';
                        } elseif ($site == 'BHQ') {
                            echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="BHQ.php" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">BHQ</span></a>';
                        } elseif ($site == 'GP') {
                            echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="GP.php" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">GP</span></a>';
                        }
                    }
                }
            }
        } else {
            // Handle query error or empty result set
            echo "No roles found.";
        }
        ?>
            
            </li>
             </ul>
              <!-- <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="login.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-account-key"></i
                  ><span class="hide-menu">Authentication </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="login.php" class="sidebar-link"
                      ><i class="mdi mdi-all-inclusive"></i
                      ><span class="hide-menu"> Login </span></a
                    >
                  </li>
                </ul>
              </li> -->
              
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>