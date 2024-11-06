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

$DisID = $_REQUEST["cities"];
//$query = "SELECT * FROM rajnet WHERE Dist_LGD_Code='$DisID'";
$query = "SELECT rn.*
FROM rajnet rn
WHERE rn.District = '$DisID'";
$fetch = mysqli_query($connection,$query);

$greenDivisions = [];
$redDivisions = [];

if ($fetch) {
    while ($row = $fetch->fetch_assoc()) {
            $DisName  = $row["District"];
            $ZoneName = $row["Zone"];
        if(!empty($row["Type_Of_Connectivity"])) 
        {
            //Assuming "Type_Of_Connectivity" determines division color
            if($row["Type_Of_Connectivity"] === 'Not Connect') 
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
$redDivisionsJSON   = json_encode($redDivisions);

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
    <!-- Content Wrapper. Contains page content -->
    
        <div class="page-wrapper" style="background-color:white;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
          <form method="POST">
               <a class="btn btn-warning text-black" href="dashboard.php"  style="margin:4px;font-size:large;height:37px;padding:3px;width:100px;margin-left:7px;" role="button">Back</a>&nbsp;&nbsp;
            </form>
            <div class="col-12 d-flex no-block align-items-center" style="margin-left: 618px;">
              <!-- <h1 class="m-0" style="font-size:22px;"> <small>Zone -</small> <?php //echo $ZoneName ?> <small>District -</small> <?php //echo $DisName ?></h1> -->
              <h1 class="m-0" style="font-size:22px;"><u><small>City -</small> <?php echo $DisName ?></u>&nbsp;<u><small>District -</small> <?php echo 'Rajasthan' ?></u></h1>
              <input type="hidden" name="district_name" id="district_name" value="<?php echo $DisName;?>"/>
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
            <!-- ============================================================== -->
      <div class="container-fluid" style="background-color: white;">
        <div class="row" id="result-container">
            <!-- Column -->
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
                                  <h6 class="text-black" style="margin:left:10px;">DHQ</h6>
                                  <table border="1">
                                            <tr class="text-black" style="background-color:black;color:white;">
                                                <th class="text-black" style="font-size: 11px;">Id</th>
                                                <th class="text-black" style="font-size: 11px;">UserTag</th>
                                                <th id="total" class="text-black" style="font-size: 11px;">Total Number of Devices</th>
                                                <th class="text-black" style="font-size: 11px;">Status(High & Low)</th>
                                            </tr>
                                            <?php
                                      //This Query Fetching Data For DHQ,List connected & Not Connected.
                                      $sql_data="SELECT
                                      UserTags,
                                      SUM(CASE WHEN Status = 'Low' THEN 1 ELSE 0 END) AS Low_Count,
                                      SUM(CASE WHEN Status = 'High' THEN 1 ELSE 0 END) AS High_Count,
                                      SUM(CASE WHEN UserTags = 'DHQ' THEN 1 ELSE 0 END) AS DHQ_Count
                                  FROM (
                                      SELECT UserTags, Status
                                      FROM asset_air_conditioner_240
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM asset_desktop_computer_272
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_diesel_generator_272`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_idu_560`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_ip_camera_272`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_lnbc_560`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_modem_1731`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_network_router_switches_11813`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_odu_560`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_rack_3801`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_ups_13142`
                                      WHERE City = '$DisName'
                                      -- Add similar SELECT statements for other tables
                                      UNION ALL
                                      SELECT User_Tags AS UserTags, Status
                                      FROM asset_ip_phone_272
                                      WHERE City = '$DisName'
                                  ) AS combined_tables
                                  WHERE UserTags IN ('DHQ')
                                  GROUP BY UserTags";
                                      $res = $connection->query($sql_data);
                                  if($res->num_rows > 0) 
                                  {
                                    $cnt=1;
                                      while($row = $res->fetch_assoc()) 
                                    {?>
                                     <tr>
                                      <td style="text-align:center;"><?php echo $cnt++;?></td>
                                      <td style="text-align:center;cursor:pointer;" id="DHQ"><?php echo $row['UserTags']; ?></td>
                                      <td style="text-align:center;"><?php echo $row["DHQ_Count"];?></td>
                                      <td style="text-align:center;"><?php echo $row["High_Count"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["Low_Count"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
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
                      <th class="text-black" style="font-size: 11px;">Id</th>
                      <th class="text-black" style="font-size: 11px;">UserTag</th>
                      <th id="total" class="text-black" style="font-size: 11px;">Total Number of Devices</th>
                      <th class="text-black" style="font-size: 11px;">Status(High & Low)</th>
                      </tr>
                      <?php
                      //This Query Fecthing Data For SHQ,List connected & Not Connected.
                          $sql_data="SELECT
                          UserTags,
                          SUM(CASE WHEN Status = 'Low' THEN 1 ELSE 0 END) AS Low_Count,
                          SUM(CASE WHEN Status = 'High' THEN 1 ELSE 0 END) AS High_Count,
                          SUM(CASE WHEN UserTags = 'SHQ' THEN 1 ELSE 0 END) AS SHQ_Count
                      FROM (
                          SELECT UserTags, Status
                          FROM asset_air_conditioner_240
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM asset_desktop_computer_272
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_diesel_generator_272`
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_idu_560`
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_ip_camera_272`
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_lnbc_560`
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_modem_1731`
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_network_router_switches_11813`
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_odu_560`
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_rack_3801`
                          WHERE City = '$DisName'
                          UNION ALL
                          SELECT UserTags, Status
                          FROM `asset_ups_13142`
                          WHERE City = '$DisName'
                          -- Add similar SELECT statements for other tables
                          UNION ALL
                          SELECT User_Tags AS UserTags, Status
                          FROM asset_ip_phone_272
                          WHERE City = '$DisName'
                      ) AS combined_tables
                      WHERE UserTags IN ('SHQ')
                      GROUP BY UserTags;";
                            $res = $connection->query($sql_data);
                           if ($res->num_rows > 0) 
                           {
                          $cnt=1;
                            while($row = $res->fetch_assoc()) 
                          {
                            ?>
                          <tr>
                            <td style="text-align:center;"><?php echo $cnt++;?></td>
                            <td style="text-align:center;cursor:pointer;" id="SHQ"><?php echo $row["UserTags"];?></td>
                            <td style="text-align:center;"><?php echo $row["SHQ_Count"];?></td>
                            <td style="text-align:center;"><?php echo $row["High_Count"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["Low_Count"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
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
                                    <th class="text-black" style="font-size: 11px;">Id</th>
                                    <th class="text-black" style="font-size: 11px;">UserTag</th>
                                    <th id="total" class="text-black" style="font-size: 11px;">Total Number of Devices</th>
                                    <th class="text-black" style="font-size: 11px;">Status(High & Low)</th>
                                </tr>
                                    <?php
                                      //This Query Fecthing Data For BHQ,List connected & Not Connected.
                                      $sql_data="SELECT
                                      UserTags,
                                      SUM(CASE WHEN Status = 'Low' THEN 1 ELSE 0 END) AS Low_Count,
                                      SUM(CASE WHEN Status = 'High' THEN 1 ELSE 0 END) AS High_Count,
                                      SUM(CASE WHEN UserTags = 'BHQ' THEN 1 ELSE 0 END) AS BHQ_Count
                                  FROM (
                                      SELECT UserTags, Status
                                      FROM asset_air_conditioner_240
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM asset_desktop_computer_272
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_diesel_generator_272`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_idu_560`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_ip_camera_272`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_lnbc_560`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_modem_1731`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_network_router_switches_11813`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_odu_560`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_rack_3801`
                                      WHERE City = '$DisName'
                                      UNION ALL
                                      SELECT UserTags, Status
                                      FROM `asset_ups_13142`
                                      WHERE City = '$DisName'
                                      -- Add similar SELECT statements for other tables
                                      UNION ALL
                                      SELECT User_Tags AS UserTags, Status
                                      FROM asset_ip_phone_272
                                      WHERE City = '$DisName'
                                  ) AS combined_tables
                                  WHERE UserTags IN ('BHQ')
                                  GROUP BY UserTags;";
                                          $res = $connection->query($sql_data);
                                      if ($res->num_rows > 0) 
                                      {
                                        $cnt=1;
                                          while($row = $res->fetch_assoc()) 
                                        {?>
                                        <tr>
                                          <td style="text-align:center;"><?php echo $cnt++;?></td>
                                          <td style="text-align:center;cursor:pointer;" id="BHQ"><?php echo $row["UserTags"];?></td>
                                          <td style="text-align:center;"><?php echo $row["BHQ_Count"];?></td>
                                          <td style="text-align:center;"><?php echo $row["High_Count"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["Low_Count"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
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
            <div class="col-md-6 col-lg-2 col-xlg-3" style="width:450px;" id="result-container"> 
              <div class="card" >
                <div class="box text-center" style="margin-left:-26px;">
                  <h1 class="font-light text-white">
                    </h1>
                    <h6 class="text-black">GP</h6>
                      <table border="1">
                              <tr class="text-black" style="background-color:black;color:white;">
                                  <th class="text-black" style="font-size: 11px;">Id</th>
                                  <th class="text-black" style="font-size: 11px;">UserTag</th>
                                  <th id="total" class="text-black" style="font-size: 11px;">Total Number of Devices</th>
                                  <th class="text-black" style="font-size: 11px;">Status(High & Low)</th>
                              </tr>
                              <?php
                                //This Query Fetching Data For GP,List connected & Not Connected.
                                $sql_data="SELECT
                                UserTags,
                                SUM(CASE WHEN Status = 'Low' THEN 1 ELSE 0 END) AS Low_Count,
                                SUM(CASE WHEN Status = 'High' THEN 1 ELSE 0 END) AS High_Count,
                                SUM(CASE WHEN UserTags = 'GP' THEN 1 ELSE 0 END) AS GP_Count
                            FROM (
                                SELECT UserTags, Status
                                FROM asset_air_conditioner_240
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM asset_desktop_computer_272
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_diesel_generator_272`
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_idu_560`
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_ip_camera_272`
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_lnbc_560`
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_modem_1731`
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_network_router_switches_11813`
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_odu_560`
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_rack_3801`
                                WHERE City = '$DisName'
                                UNION ALL
                                SELECT UserTags, Status
                                FROM `asset_ups_13142`
                                WHERE City = '$DisName'
                                -- Add similar SELECT statements for other tables
                                UNION ALL
                                SELECT User_Tags AS UserTags, Status
                                FROM asset_ip_phone_272
                                WHERE City = '$DisName'
                            ) AS combined_tables
                            WHERE UserTags IN ('GP')
                            GROUP BY UserTags;";
                                      $res = $connection->query($sql_data);
                                  if ($res->num_rows > 0) 
                                  {
                                    $cnt=1;
                                      while($row = $res->fetch_assoc()) 
                                    {?>
                                      <tr class="text-black">
                                        <td style="text-align:center;"><?php echo $cnt++;?></td>
                                        <td style="text-align:center;cursor:pointer;" id="GP"><?php echo $row['UserTags']; ?></a></td>
                                        <td style="text-align:center;"><?php echo $row['GP_Count']; ?></a></td>
                                        <td style="text-align:center;"><?php echo $row["High_Count"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["Low_Count"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
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
                  <h1 class="font-light text-white">
                  </h1>
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
        <div style="margin-top: -194px;">
            <!--DHQ Data--->
            <div id="content" style="margin-left: 294px;margin-top:-23px;display:none;">
                        <table id="districttable"   style="height: 300px;  display: block; border-collapse: collapse; table-layout: fixed;width:1739px;margin-left: -300px;">
                       <!-- Cities will be displayed here -->
                       </table>
                       <table id="districttable2"   style="height: 549px;  display: block; border-collapse: collapse; table-layout: fixed;width:1616px;margin-left:-306px;padding-right: 15px;">
                       <!-- Cities will be displayed here -->
                       </table>
                       <table id="districttable3" style="height:273px;  display:block;border-collapse:collapse;tablelayout:fixed;width: 1572px;margin-left:-311px;font-size:10px;margin-top:-103px;">
                       <!-- Cities will be displayed here -->
                       </table>
                       <table id="districttable4" style="height:273px;  display:block;border-collapse:collapse;tablelayout:fixed;width: 1572px;margin-left:-346px;font-size:10px;margin-top:-103px;">
                       <!-- Cities will be displayed here -->
                       </table>
                     </div>
                   <div id="citytable" style="margin-left:147px;margin-top:-300px;"></div>
                           <!-- Div to display role table information -->
                      <div id="roleTable" style="margin-left:220px;margin-top:-73px;"></div>
                      <!-- Table to display district information -->
                      <div id="districtInfo" style="display: none;"></div>
                        <table id="districtTable" class="datatablesSimples" border="1">
                            <tbody>
                                 <!-- District information will be populated here -->
                            </tbody>
                       </table>
        <!---DHQ Data-->  
   </div>
   <br/><br/><br/><br/><br/><br/><br/><br/>
   <br/><br/><br/><br/><br/><br/><br/><br/>
   <br/><br/><br/><br/><br/><br/><br/><br/>
   <br/><br/><br/><br/><br/><br/><br/><br/>
       </div>
       
     </div>

     </div>
            
  </div>
  
 </div>
 </div> 
</div>

<!-- =========footer============== -->
<?php include 'footer.php';?>
  <!-- =========footer============== -->
<script type="text/Javascript">
//It will bind all the district and cities acc. to BHQ Site and user's Id.

$(document).ready(function() 
{
  $("#content").hide();  
  $('#DHQ').click(function() {
        $("#content").show();
        $("#districttable2").hide();
        $("#districttable3").hide();
        $("#districttable4").hide();
        $("#districttable").show();
        // $.ajax({
        //     url: 'GetDHQ.php', //getdistrict.php.This page will fetch cities.
        //     type: 'GET',
        //     success: function(response) 
        //     {
        //         $('#districttable').html(response);
        //     },
        //     error: function(xhr, status, error) 
        //     {
        //         console.error(xhr.responseText); // Log the error response
        //     }
        // });
        var cityName = $("#district_name").val(); // city name we have to send
        console.log(cityName);
        $.ajax({
        url: 'GetDHQ.php',
        type: 'GET',
        data: { city: cityName }, // Send city name as data to the server
        success: function(response) {
            $('#districttable').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    });

    $('#SHQ').click(function() {
        $("#content").show();
        $("#districttable2").show();
        $("#districttable3").hide();
        $("#districttable4").hide();
        $("#districttable").hide();
        // $.ajax({
        //     url: 'GetDHQ.php', //getdistrict.php.This page will fetch cities.
        //     type: 'GET',
        //     success: function(response) 
        //     {
        //         $('#districttable').html(response);
        //     },
        //     error: function(xhr, status, error) 
        //     {
        //         console.error(xhr.responseText); // Log the error response
        //     }
        // });
        var cityName = $("#district_name").val(); // city name we have to send
        console.log(cityName);
        $.ajax({
        url: 'GetSHQ.php',
        type: 'GET',
        data: { city: cityName }, // Send city name as data to the server
        success: function(response) {
            $('#districttable2').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    });

    $('#BHQ').click(function() {
        $("#content").show();
        $("#districttable3").show();
        $("#districttable2").hide();
        $("#districttable4").hide();
        $("#districttable").hide();
        // $.ajax({
        //     url: 'GetDHQ.php', //getdistrict.php.This page will fetch cities.
        //     type: 'GET',
        //     success: function(response) 
        //     {
        //         $('#districttable').html(response);
        //     },
        //     error: function(xhr, status, error) 
        //     {
        //         console.error(xhr.responseText); // Log the error response
        //     }
        // });
        var cityName = $("#district_name").val(); // city name we have to send
        console.log(cityName);
        $.ajax({
        url: 'GetBHQ.php',
        type: 'GET',
        data: { city: cityName }, // Send city name as data to the server
        success: function(response) {
            $('#districttable3').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    });

    $('#GP').click(function() 
    {
        $("#content").show();
        $("#districttable2").hide();
        $("#districttable3").hide();
        $("#districttable").hide();
        $("#districttable4").show();
        // $.ajax({
        //     url: 'GetDHQ.php', //getdistrict.php.This page will fetch cities.
        //     type: 'GET',
        //     success: function(response) 
        //     {
        //         $('#districttable').html(response);
        //     },
        //     error: function(xhr, status, error) 
        //     {
        //         console.error(xhr.responseText); // Log the error response
        //     }
        // });
        var cityName = $("#district_name").val(); // city name we have to send
        console.log(cityName);
        $.ajax({
        url: 'GetGP.php',
        type: 'GET',
        data: { city: cityName }, // Send city name as data to the server
        success: function(response) {
            $('#districttable4').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    });
    // Click event for districts
    // $(document).on('click', '.city', function() {
    //     var districtId = $(this).data('districtid'); // Get the district ID from the clicked element
    //     console.log(districtId);
    //     if (districtId !== '') 
    //     {
    //         $.ajax({
    //             url: 'getcities.php', //getcities.php.This page will fetch cities.
    //             type: 'GET',
    //             data: { districtId: districtId }, // Pass district ID to fetch cities
    //             success: function(response) {
    //                 $('#citytable').html(response);
    //                 $('#citytable').show(); // Show the cities when loaded
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText); // Log the error response
    //             }
    //         });
    //     }
    // });

    // Click event for cities
    // $(document).on('click', '.cityOne', function() {
    //     var cityId = $(this).data('cityid');
    //     console.log(cityId + ' Hello get vertical info');

    //     if (cityId !== '') {
    //         $.ajax({
    //             url: 'get_Vertical_Info.php',  //get_Vertical_Info.This page will fetch data acc. to the cities.
    //             type: 'GET',
    //             data: { cityId: cityId },
    //             success: function(response) 
    //             {
    //                 $('#roleTable').html(response);
    //                 $('#roleTable').show();
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText);
    //             }
    //         });
    //     }
    // });
});

document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('content');
    const tables = document.querySelectorAll('.districttable');

    toggleButton.addEventListener('click', function() {
        tables.forEach(table => {
            if (table.style.display === 'none' || table.style.display === '') {
                table.style.display = 'table'; // Show the table
            } else {
                table.style.display = 'none'; // Hide the table
            }
        });
    });
});
</script>  
