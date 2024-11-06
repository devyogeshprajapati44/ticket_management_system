<?php
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';
?>

<style>
    .datatablesSimples,table, th, td {
     
  border: 1px solid black;
  border-collapse: collapse;
  background: white;
  
  
    }
    .dataTables_filter{
      margin-left: 550px;
    }
    .dataTables_paginate{
      margin-left: 550px;
    }
    .dataTables_info{
      margin-left: 20px;
    }
    .dataTables_length{
      margin-left: 21px;
    }
    
</style>
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
           
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      TMS
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
          <!-- Start Page Content Table Content -->
          <!-- ============================================================== -->
        <div class="container-fluid">
          <div class="row" style="margin-right: -794px;">
            <div class="col-md-8">
              <div class="card" style="margin-bottom: 29px;">
                <div class="card-body">
                <h2 style="color:#012970;">VIEW USER</h2>
                  
                  </div>
                   <div class="table-responsive">
                     <table id="zero_config" class="table" style="margin-left:26px;margin-right:2px;width:97%;">
                      <thead>
                        <tr class="text-white" style="text-align:center;background-color:black;">
                            <th class="text-white">Id</th>
                            <th class="text-white">Name</th>
                            <th class="text-white">User Name</th>
                            <th class="text-white">Password</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            $sql_data="SELECT * FROM `employee`";
                            $res = $connection->query($sql_data);
                            if ($res->num_rows > 0) 
                            {
                              $cnt=1;
                                while($row = $res->fetch_assoc()) 
                              {?>
                            <tr style="text-align:center;">
                            <td><?php echo $cnt++;?></td>
                            <td><?php echo $row["emp_name"];?></td>
                            <td><?php echo $row["username"];?></td>
                            <td><?php echo $row["original_password"];?></td>
                            <td>Done</td>
                             <td>
                                <div class="dropdown">
                                   <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                      </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form method="POST">
                                            <!-- <button id="singlebuttonView" name="empView" value="<?php //echo $row["role_id"];?>" class="btn btn-success">View</button>
                                            <button id="singlebuttonedit" name="empEdit" value="<?php // echo $row["role_id"]; ?>" class="btn btn-primary">Edit</button>
                                            <button id="singlebuttonDelete" name="empDelete" value="<?php  // echo $row["role_id"];?>" class="btn btn-danger">Delete</button> -->
                                            <a href="empView.php?Id=<?php echo $row["Id"];?>" id="singlebuttonView" class="btn btn-danger">View</a>
                                            <a href="empEdit.php?Id=<?php echo $row["Id"];?>"  id="singlebuttonedit"  class="btn btn-primary">Edit</a>
                                            <a href="empDelete.php?Id=<?php echo $row["Id"];?>" id="singlebuttonDelete" class="btn btn-success">Delete</a>
                                            </form>
                                        </div>
                                 </div>
                             </td>
                           </tr>
                          <?php
                          }
                        }
                    ?>
                      </tbody>
                    </table>

                    <?php
 
                    ?>
                  </div>
                </div>
             
      </div>
   </div>
</div>
<!-- ==============footer========== -->
<?php include 'footer.php';?>
<!-- ==============footer========== -->
<script>
    new DataTable('#zero_config');
</script>

