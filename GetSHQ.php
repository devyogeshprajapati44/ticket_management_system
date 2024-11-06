<?php
/* DHQ page. */
//include 'PFC.php';
include 'connection.php';
//include 'sidebar.php';
?>

<style>
    td,th 
{
  border: 1px solid #dddddd;
  text-align: left;
  padding: 5px;
}
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
       
        <div class="container-fluid" style="margin-left: 26px;">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row" style="margin-right: -594px;">
            <div class="col-md-8">
              <div class="card" style="margin-bottom: 29px;">
                <div class="card-body">
                  <h5 class="card-title mb-0">SHQ</h5>
                </div>
                <div class="table-responsive">
                    <table id="zero_confing" class="table table-bordered" style="margin-left:26px;margin-right:2px;width:97%;">
                      <thead>
                        <tr class="text-white" style="text-align:center;background-color:black;">
                            <th class="text-white">Id</th>
                            <th class="text-white">Asset ID</th>
                            <th class="text-white">Name</th>
                            <th class="text-white">User Tags</th>
                            <th class="text-white">Asset Tags</th>
                            <th class="text-white">Location</th>
                            <th class="text-white">City</th>
                            <th class="text-white">District</th>
                            <th class="text-white">Location State</th>
                            <th class="text-white">Asset State</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      //Total count of Connected and Not Connected of  all device like Router,Switches,CPU,Webcam Acc. to Site DHQ.
                      if(isset($_GET['city']))
                      {
                        
                        $cityName = $_GET['city'];

                        $sql_data="SELECT 
                        routers.`Id`, routers.`Asset ID`, routers.`Name`, routers.`UserTags`, routers.`Asset Tags`, routers.`Location`, routers.`City`, routers.`District`, routers.`Location State`, routers.`Asset State`
                    FROM 
                        asset_network_router_switches_11813 routers
                    LEFT JOIN 
                        asset_air_conditioner_240 ac ON routers.UserTags = ac.UserTags
                    LEFT JOIN 
                        asset_desktop_computer_272 dc ON routers.UserTags = dc.UserTags
                    LEFT JOIN 
                        asset_diesel_generator_272 dg ON routers.UserTags = dg.UserTags
                    LEFT JOIN 
                        asset_idu_560 iu ON routers.UserTags = iu.UserTags
                    LEFT JOIN 
                        asset_ip_camera_272 ic ON routers.UserTags = ic.UserTags
                    LEFT JOIN 
                        asset_lnbc_560 lnbc ON routers.UserTags = lnbc.UserTags
                    LEFT JOIN 
                        asset_modem_1731 modem ON routers.UserTags = modem.UserTags
                    LEFT JOIN 
                        asset_odu_560 odu ON routers.UserTags = odu.UserTags
                    LEFT JOIN 
                        asset_rack_3801 rack ON routers.UserTags = rack.UserTags
                    LEFT JOIN 
                        asset_ups_13142 ups ON routers.UserTags = ups.UserTags
                    WHERE 
                        routers.UserTags = 'SHQ' and routers.City = '$cityName'";
                      }
                        //     $sql_data="SELECT 
                        //     routers.`Id`, routers.`Asset ID`, routers.`Name`, routers.`UserTags`, routers.`Asset Tags`, routers.`Location`, routers.`City`, routers.`District`, routers.`Location State`, routers.`Asset State`
                        // FROM 
                        //     asset_network_router_switches_11813 routers
                        // LEFT JOIN 
                        //     asset_air_conditioner_240 ac ON routers.UserTags = ac.UserTags
                        // LEFT JOIN 
                        //     asset_desktop_computer_272 dc ON routers.UserTags = dc.UserTags
                        // LEFT JOIN 
                        //     asset_diesel_generator_272 dg ON routers.UserTags = dg.UserTags
                        // LEFT JOIN 
                        //     asset_idu_560 iu ON routers.UserTags = iu.UserTags
                        // LEFT JOIN 
                        //     asset_ip_camera_272 ic ON routers.UserTags = ic.UserTags
                        // LEFT JOIN 
                        //     asset_lnbc_560 lnbc ON routers.UserTags = lnbc.UserTags
                        // LEFT JOIN 
                        //     asset_modem_1731 modem ON routers.UserTags = modem.UserTags
                        // LEFT JOIN 
                        //     asset_odu_560 odu ON routers.UserTags = odu.UserTags
                        // LEFT JOIN 
                        //     asset_rack_3801 rack ON routers.UserTags = rack.UserTags
                        // LEFT JOIN 
                        //     asset_ups_13142 ups ON routers.UserTags = ups.UserTags
                        // WHERE 
                        //     routers.UserTags = 'SHQ' and routers.City = 'Jaisalmer'";
                            $res = $connection->query($sql_data);
                        if ($res->num_rows > 0) 
                        {
                          $cnt=1;
                            while($row = $res->fetch_assoc()) 
                          {?>
                            <tr style="text-align:center;">
                            <td><?php echo $cnt++;?></td>
                            <td><?php echo $row["Asset ID"];?></td>
                            <td><?php echo $row["Name"];?></td>
                            <td><?php echo $row["UserTags"];?></td>
                            <td><?php echo $row["Asset Tags"];?></td>
                            <td><?php echo $row["Location"];?></td>
                            <td><?php echo $row["City"];?></td>
                            <td><?php echo $row["District"];?></td>
                            <td><?php echo $row["Location State"];?></td>
                            <td><?php echo $row["Asset State"];?></td>
                            </tr>
                          <?php
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                 
                  </div>
    </div>
   </div>
</div>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="dist/js/jquery.dataTables.min.js"></script>
<script src="dist/js/dataTables.bootstrap4.min.js"></script>

<script type="text/Javascript">
   new DataTable('#zero_confing');
</script>