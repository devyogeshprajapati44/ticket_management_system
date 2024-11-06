<?php
error_reporting(0);
session_start();
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';
$sql_compliant="SELECT * FROM `complaints` where `type`='HQLevel' order by `Id` DESC";

$fetch_compl = mysqli_query($connection,$sql_compliant);
$row_compl = $fetch_compl->fetch_assoc();
$complaint_number=$row_compl["complaint_number"];
$complaint_date=$row_compl["complaint_register_date"];

$DisID = $_REQUEST["DID"];
//$query = "SELECT * FROM rajnet WHERE Dist_LGD_Code='$DisID'";
$query = "SELECT rn.*
FROM rajnet rn
WHERE rn.Dist_LGD_Code = '$DisID'";
$fetch = mysqli_query($connection, $query);

$greenDivisions = [];
$redDivisions = [];

if ($fetch) {
    while ($row = $fetch->fetch_assoc()) {
            $DisName  = $row["District"];
            $ZoneName = $row["Zone"];
        if (!empty($row["Type_Of_Connectivity"])) {
            //Assuming "Type_Of_Connectivity" determines division color
            if ($row["Type_Of_Connectivity"] === 'Not Connect') 
            {
                $redDivisions[]   = $row["Type_Of_Connectivity"];
            } 
            else 
            {
                $greenDivisions[] = $row["Type_Of_Connectivity"];
            }
        }
    }
} else {
    // Handle the case where the query fails
    echo "Query failed: " . mysqli_error($connection);
}


// JSON encode the arrays to be used in JavaScript.
$greenDivisionsJSON = json_encode($greenDivisions);
$redDivisionsJSON = json_encode($redDivisions);

?>
<style>

.dataTables_filter{
  margin-left: 609px;
}
.dataTables_paginate{
  margin-left: 720px;
}
.dataTables_info{
  margin-left: 20px;
}
.dataTables_length{
  margin-left: 21px;
}
</style>
    <!-- Content Wrapper. Contains page content -->
    
        <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
          <form method="POST">
               <a class="btn btn-warning text-black" href="dashboard.php"  style="margin:4px;font-size:large;height:37px;padding:3px;width:100px;margin-left:7px;" role="button">Back</a>&nbsp;&nbsp;
            </form>
            <div class="col-12 d-flex no-block align-items-center">
              <h1 class="m-0"> Zone - <?php echo $ZoneName ?> <small>District - <?php echo $DisName ?></small></h1>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      TMS
                    </li>
                  </ol> -->
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- /.content-header -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row" style="margin-right: -794px;">
            <div class="col-md-8">
              <div class="card" style="margin-bottom: 29px;">
              <div class="container-fluid">
                <div class="row">
                    <div class="col-12"><br>
                <div class="table-responsive">
                    <!-- <div style="width:50%;margin-left: 444px;background-color:lightblue;">
                        <marquee direction = "right" behavior="scroll" scrollamount="10" style="padding-top:30px;padding-bottom:30px;font-size:21px;"><?php // echo strtoupper('Ticket No :- '.$complaint_number .' And Date :- '. $complaint_date);?></marquee>
                        </div><br/> -->
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title"><?php echo $DisName?> - H.Q LEVEL</h3>

                               
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>POP Code</th>
                                        <th>Division Name</th>
                                        <th>Division Code</th>
                                        <th>District Name</th>
                                        <th>District Code</th>
                                        <th>Block Name</th>
                                        <th>Block Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                   $Counter=0;
                                   //echo $sql="SELECT `RAJN`.*,`RAJNW`.* FROM `rajnet` `RAJN` LEFT JOIN `rajswan` `RAJNW` ON `RAJNW`.`HO_id`=`RAJN`.`r_id` where `RAJN`.`Dist_LGD_Code`='$DisID';";
                                   //echo $sql="SELECT `Id`, `Vertical_POP_Code`, `Division_Name`, `Division_Code`, `District_Name`, `District_Code`, `Block_Name`, `Block_Code` FROM `dhq_inventory_with_assetid` WHERE `District_Code`='$DisID';";
                                   //$fetch = mysqli_query($connection, "SELECT `Id`, `Vertical_POP_Code`, `Division_Name`, `Division_Code`, `District_Name`, `District_Code`, `Block_Name`, `Block_Code` FROM `dhq_inventory_with_assetid` WHERE `District_Code`='$DisID';");
                                   $fetch = mysqli_query($connection, "SELECT `rj`.*,`di`.* FROM `rajnet` `rj` LEFT JOIN `dhq_inventory_with_assetid` `di` ON `rj`.`r_id`=`di`.`Id` WHERE `di`.`District_Code`='$DisID';");
                                   while ($row = $fetch->fetch_assoc()) {
                                       ?>
                                       <tr>
                                           <td><?php echo ++$Counter; ?></td>
                                           <!-- <td>-->
                                               <?php 
                                               // if($row["Type_Of_Connectivity"]=="No Connect")
                                               // {
                                               //     echo '<img src="assets/images/stop.gif" alt="Raj Logo" width="50" style="opacity: .8">';
                                               // }else{
                                               //     echo '<img src="assets/images/live.gif" alt="Raj Logo" width="50" style="opacity: .8">';
                                               // }
                                               ?>
                                               <!-- </td> RajNetView?<?php //echo $row["Unique_Code"]; ?>-->
                                           <!-- <td><a href="#"><?php //echo $row["Id"]; ?></a></td> -->
                                           <td><?php echo $row["Vertical_POP_Code"]; ?></td>
                                           <td><?php echo $row["Division_Name"]; ?></td>
                                           <td><?php echo $row["Division_Code"]; ?></td>
                                           <td><?php echo $row["District_Name"]; ?></td>
                                           <td><?php echo $row["District_Code"]; ?></td>
                                           <td><?php echo $row["Block_Name"]; ?></td>
                                           <td><?php echo $row["Block_Code"]; ?></td>
                                           <td>
                                           <?php    
                                              if($row["Type_Of_Connectivity"]=="No Connect")
                                                {
                                                echo '<img src="assets/images/down_arrow.png" alt="TMS_down_Logo" width="50" style="opacity: .8;width: 22px;margin-left: 24px;background-color: transparent;">';
                                                }
                                               else
                                                {
                                                 echo '<img src="assets/images/up_arrow_green.jpg" alt="TMS_UP_Logo" width="50" style="opacity: .8;width:29px;margin-left:20px;background-color: transparent;">';
                                                } 
                                            ?>
                                               </td>
                                           <td><a href="view_vertical_zone_details.php?ID=<?php echo $row["Id"]; ?>" class="btn btn-primary">VIEW DETAILS</a>
                                               <!-- <form method="post">
                                                   <button type="submit" name="view_details" value="<?php //echo $row["HO_id"];?>view_vertical_zone_details.php?ID=<?php //echo $row["Id"];?>" class="btn btn-primary">VIEW DETAILS</button>
                                               </form> -->
                                           </td>
                                       </tr>
                                   <?php
                                   }
                                   ?>

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title"><?php echo $DisName ?> - GP LEVEL</h3>
                            </div>
                            <div class="card-body" >
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>UID</th>
                                        <th>Gram Panchayat Name</th>
                                        <th>PS Name</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $Counter=0;
                                    //echo $Sql_hori="select * from rajswan where Dist_LGD_Code = '$DisID'";
                                    //echo $Sql_hori="SELECT `RAJN`.*,`RAJNW`.* FROM `rajnet` `RAJN` LEFT JOIN `rajswan` `RAJNW` ON `RAJNW`.`HO_id`=`RAJN`.`r_id` where `RAJNW`.`Dist_LGD_Code`='$DisID'";
                                    $fetch = mysqli_query($connection, "SELECT `RAJN`.*,`RAJNW`.* FROM `rajnet` `RAJN` LEFT JOIN `rajswan` `RAJNW` ON `RAJNW`.`HO_id`=`RAJN`.`r_id` where `RAJNW`.`Dist_LGD_Code`='$DisID'");
                                    while ($row = $fetch->fetch_assoc()) {
                                        ?>
                                        <tr>
                                        <td><?php echo ++$Counter; ?></td>    
                                        <td><?php echo $row["Unique_Code"]; ?></td>
                                        <td><?php echo $row["GP_Name"]; ?></td>
                                        <td><?php echo $row["PS_Name"]; ?></td>
                                        <td>
                                        <?php    if($row["Type_Of_Connectivity"]=="No Connect")
                                                 {
                                                 echo '<img src="assets/images/down_arrow.png" alt="TMS_down_Logo" width="50" style="opacity: .8;width: 22px;margin-left: 24px;background-color: transparent;">';
                                                 }
                                                else
                                                 {
                                                  echo '<img src="assets/images/up_arrow_green.jpg" alt="TMS_UP_Logo" width="50" style="opacity: .8;width:29px;margin-left:20px;background-color: transparent;">';
                                                 } 
                                          ?>
                                        </td>
                                          <td><a href="view_GP_level_details.php?ID=<?php echo $row["r_id"];?>" class="btn btn-primary">VIEW DETAILS</a>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                    </tbody>

                                </table>
                                </div>
   </div>
</div>

</div>                

                
   


    
    
<!-- =========footer============== -->
<?php include 'footer.php';?>
  <!-- =========footer============== -->
  <script>

new DataTable('#example1');
new DataTable('#example2');

    
</script>