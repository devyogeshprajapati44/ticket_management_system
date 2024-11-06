<?php 
/* Dashboard page. */
include 'PFC.php';
//include 'connection.php';
include 'sidebar.php';

$user_id=$_SESSION['PFC_UID']; // Taking Id of logged In User in session.
?>

<style>
td,th 
{
  border: 1px solid #dddddd;
  text-align: left;
  padding: 5px;
}
</style>
      <!-- ============================================================== -->
      <!-- Page wrapper -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Dashboard</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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
          <!-- End Bread crumb and right sidebar toggle -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Container fluid  -->
          <!-- ============================================================== -->
<div class="container-fluid" style="background-color: white;">
  <div class="row">
   <!-- Column -->
    <div class="col-md-6 col-lg-2 col-xlg-3" style="margin-left:12px;">
      <div class="card" style="width:385px;">
        <div class="box  text-center">
          <h1 class="font-light text-white"></h1>
                      <?php
                      $DHQ = '';
                      $SHQ = '';
                      $BHQ = '';
                      $GP = '';
                        // Fetch data from the 'roles' table.
                        $query = "SELECT * FROM `roles` where user_id='$user_id'";
                        $result = mysqli_query($connection,$query);
                        
                      if ($result) {
                      // Fetch associative array from the result
                        while ($row = mysqli_fetch_assoc($result)) {
                          // Check conditions for each row's role_name
                          //$sites=explode(',',$row["role_name"]);
                          $sites=explode(',',$row["role_name"]);
                            //print_r($sites);
                            //print_r($sites[1]);

                          //echo $row["role_name"];
                          foreach($sites as $st)
                          {
                              if ($st == 'DHQ') 
                              {
                                $DHQ = 'DHQ';
                              }
                  
                              if ($st == 'SHQ') 
                              {
                                  $SHQ = 'SHQ';
                              }
                  
                              if ($st == 'BHQ') 
                              {
                                  $BHQ = 'BHQ';
                              }
                  
                              if ($st == 'GP') 
                              {
                                  $GP = 'GP';
                              }
                            }
                          if($DHQ === 'DHQ') 
                          {
                          ?>
                          <h6 class="text-black">DHQ</h6>
                          <table border="1">
                                    <tr class="text-black" style="background-color:black;color:white;">
                                        <th>Id</th>
                                        <th>Segment</th>
                                        <th id="total">Total Number of Devices</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php
                              //This Query Fetching Data For DHQ,List connected & Not Connected.
                              $sql_data="SELECT 
                              segment,
                              COUNT(*) AS `total_devices`,
                              SUM(CASE WHEN `status` = 'connected' THEN 1 ELSE 0 END) AS connected_devices,
                              SUM(CASE WHEN `status` = 'Not connected' THEN 1 ELSE 0 END) AS not_connected_devices
                          FROM 
                              `segment`
                          WHERE 
                              segment = 'DHQ'
                          GROUP BY 
                              segment";
                              $res = $connection->query($sql_data);
                          if($res->num_rows > 0) 
                          {
                            $cnt=1;
                              while($row = $res->fetch_assoc()) 
                            {?>
                              <tr>
                              <td style="text-align:center;"><?php echo $cnt++;?></td>
                              <td style="text-align:center;"><?php echo $row["segment"];?></td>
                              <td style="text-align:center;"><?php echo $row["total_devices"];?></td>
                              <td style="text-align:center;"><?php echo $row["connected_devices"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["not_connected_devices"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                              </tr>
                                <?php
                                    }
                                }
                                ?> 
                            </table> 
                        </div>
                      </div>
                    </div>
                    <?php } if ($SHQ === 'SHQ') {?>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3" style="margin-left:105px;"> 
              <div class="card" style="width:0px;">
                <div  class="box text-center" style="width:385px;">
                  <h1 class="font-light text-white">
                  </h1>
                  <h6 class="text-black">SHQ</h6>
                  <table border="1">
                      <tr style="background-color:black;color:white;">
                          <th>Id</th>
                          <th>Segment</th>
                          <th id="total">Total Number of Devices</th>
                          <th>Status</th>
                      </tr>
                      <?php
                      //This Query Fecthing Data For SHQ,List connected & Not Connected.
                          $sql_data="SELECT  `segment`,
                          COUNT(*) AS total_devices,
                          SUM(CASE WHEN `status` = 'connected' THEN 1 ELSE 0 END) AS `connected_devices`,
                          SUM(CASE WHEN `status` = 'Not connected' THEN 1 ELSE 0 END) AS `not_connected_devices`
                          FROM 
                            `segment`
                          WHERE 
                            `segment` = 'SHQ'
                          GROUP BY 
                            `segment`";
                            $res = $connection->query($sql_data);
                           if ($res->num_rows > 0) 
                           {
                          $cnt=1;
                            while($row = $res->fetch_assoc()) 
                          {
                            ?>
                          <tr>
                            <td style="text-align:center;"><?php echo $cnt++;?></td>
                            <td style="text-align:center;"><?php echo $row["segment"];?></td>
                            <td style="text-align:center;"><?php echo $row["total_devices"];?></td>
                            <td style="text-align:center;"><?php echo $row["connected_devices"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["not_connected_devices"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                          </tr>
                        <?php
                            }
                          }
                        ?> 
                    </table>
                    </div>
                  </div>
                </div>
               <?php } if ($BHQ === 'BHQ') {  ?>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3" style="width:251px;margin-left:-3px;"> 
              <div class="card" style="margin-left:-156px;margin-top:8px;">
                <div class="box text-center">
                     <h6 class="text-black">BHQ</h6>
                        <table border="1">
                                <tr style="background-color:black;color:white;">
                                    <th>Id</th>
                                    <th>Segment</th>
                                    <th id="total">Total Number of Devices</th>
                                    <th>Status</th>
                                </tr>
                                    <?php
                                      //This Query Fecthing Data For BHQ,List connected & Not Connected.
                                      $sql_data="SELECT 
                                      segment,
                                      COUNT(*) AS total_devices,
                                      SUM(CASE WHEN `status` = 'connected' THEN 1 ELSE 0 END) AS connected_devices,
                                      SUM(CASE WHEN `status` = 'Not connected' THEN 1 ELSE 0 END) AS not_connected_devices
                                      FROM 
                                          `segment`
                                      WHERE 
                                          segment = 'BHQ'
                                      GROUP BY 
                                          segment";
                                          $res = $connection->query($sql_data);
                                      if ($res->num_rows > 0) 
                                      {
                                        $cnt=1;
                                          while($row = $res->fetch_assoc()) 
                                        {?>
                                        <tr>
                                          <td style="text-align:center;"><?php echo $cnt++;?></td>
                                          <td style="text-align:center;"><?php echo $row["segment"];?></td>
                                          <td style="text-align:center;"><?php echo $row["total_devices"];?></td>
                                          <td style="text-align:center;"><?php echo $row["connected_devices"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["not_connected_devices"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                                          </tr>
                                        <?php
                                        }
                                      }
                                      ?> 
                             </table>
                          </div>
                       </div>
                     </div>
                    <!-- Column -->
                    <?php } if ($GP === 'GP') {?>
                    <div class="col-md-6 col-lg-2 col-xlg-3" style="width:450px;"> 
                      <div class="card">
                        <div class="box text-center" style="margin-left:-26px;">
                          <h1 class="font-light text-white">
                            </h1>
                            <h6 class="text-black">GP</h6>
                              <table border="1">
                                      <tr class="text-black" style="background-color:black;color:white;">
                                          <th>Id</th>
                                          <th>Segment</th>
                                          <th id="total">Total Number of Devices</th>
                                          <th>Status</th>
                                      </tr>
                                      <?php
                                        //This Query Fecthing Data For GP,List connected & Not Connected.
                                        $sql_data="SELECT 
                                        segment,
                                        COUNT(*) AS total_devices,
                                        SUM(CASE WHEN `status` = 'connected' THEN 1 ELSE 0 END) AS connected_devices,
                                        SUM(CASE WHEN `status` = 'Not connected' THEN 1 ELSE 0 END) AS not_connected_devices
                                          FROM 
                                                `segment`
                                            WHERE 
                                                segment = 'GP'
                                            GROUP BY 
                                      segment";
                                      $res = $connection->query($sql_data);
                                  if ($res->num_rows > 0) 
                                  {
                                    $cnt=1;
                                      while($row = $res->fetch_assoc()) 
                                    {?>
                                      <tr class="text-black">
                                        <td style="text-align:center;"><?php echo $cnt++;?></td>
                                        <td style="text-align:center;"><?php echo $row["segment"];?></td>
                                        <td style="text-align:center;"><?php echo $row["total_devices"];?></td>
                                        <td style="text-align:center;"><?php echo $row["connected_devices"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["not_connected_devices"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                                      </tr>
                              <?php
                              }
                            }
                            ?> 
                        </table>
                        </div>
                      </div>
                    </div>
                  </div>
                 <?php } else {?>
                    <div class="col-md-6 col-lg-2 col-xlg-3" style="width:450px;"> 
                       <div class="card">
                         <div class="box text-center" style="margin-left:-26px;">
                             <h1 class="font-light text-white"></h1>
                              <h6 class="text-black"></h6>
                              </table>
                                    </div>
                                   </div>
                                  </div>
                                 </div> 
                                  <?php
                                      }
                                  }
                              } else {
                                  // Handle query error
                                  echo "Error: " . mysqli_error($connection);
                              }

                          // Close the connection
                          //mysqli_close($connection);
                    ?>    
                  </div>           
                </div>
               </div>
              <!-- column -->
              <!-- column -->
         </div>
       </div>
     </div>
    </div>
  </div>
 </div> 
 </div>                  
          <!-- ============================================================== -->
          <!--chart start-->
          <!-- ============================================================== -->
            <?php //if($_SESSION['PFC_UID']==1){?> 

          <div class="row">
             <div class="col-md-12">
                <div class="d-md-flex align-items-center" style="margin-left:980px;margin-top:200px;"> <div>
                  <h4 class="card-title" style="color:black;">Rajasthan Map</h4>
                    </div>
                      </div>
                        <img src="assets/images/Rajasthan.png" class="rounded" alt="Cinque Terre" style="height:413px;width:487px; margin-left:979px;">
                          <div class="col-md-6">
                            <div class="card" style="margin-top: -420px;">
                             <div class="card-body">
                               <h4 class="card-title" style="margin-left:307px;color:black;">TOP 4 DISTRICT</h4>
                                <canvas id="myChart"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                       <!--chart End-->
                    <?php //} ?>
      

<!-- ======footer=========== -->
<?php include 'footer.php';?>
<!-- ======footer=========== -->
<!--This Is Used For ChartJs-->
<script type="text/javascript">
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Azmer","Bundi","Udaipur", "Jaipur"],
    datasets: [{
      label: '',
      data: [30, 29, 5, 5, 3, 17],
      backgroundColor: "rgb(0, 128, 0)"
    }, {
      label: '',
      data: [12, 19, 3, 17,3, 17],
      backgroundColor: "rgb(255, 0, 0)"
    }]
  }
});
</script>
