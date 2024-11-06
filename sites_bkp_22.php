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
    
        <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
          <form method="POST">
               <a class="btn btn-warning text-black" href="dashboard.php"  style="margin:4px;font-size:large;height:37px;padding:3px;width:100px;margin-left:7px;" role="button">Back</a>&nbsp;&nbsp;
            </form>
            <div class="col-12 d-flex no-block align-items-center" style="margin-left: 618px;">
              <h1 class="m-0" style="font-size:22px;"> <small>Zone -</small> <?php echo $ZoneName ?> <small>District -</small> <?php echo $DisName ?></h1>
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
                                      <!-- <td style="text-align:center;"><?php echo $row["segment"];?></td> -->
                                      <td style="text-align:center;">
                                            <a href="#" onclick="DhqData()('<?php echo urlencode($row['segment']); ?>')"> <?php echo $row['segment']; ?></a>
                                        </td>
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
                                          <td style="text-align:center;">
                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?segment=<?php echo $row["segment"]; ?>">
                                        <?php echo $row["segment"]; ?>
                                    </a>
                                </td>

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
            <div class="col-md-6 col-lg-2 col-xlg-3" style="width:450px;" id="result-container"> 
              <div class="card" >
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
                                        <td style="text-align:center;">
                                            <a href="#" onclick="fetchData()('<?php echo urlencode($row['segment']); ?>')"> <?php echo $row['segment']; ?></a>
                                        </td>
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
                  <h1 class="font-light text-white">
                  </h1>
                  <h6 class="text-black"></h6>
                 </table>
                </div>
                <div id="content" style="margin-left: 306px;margin-top: 79px;display:none;">
                        <table id="districttable" style="height: 300px;overflow-y: scroll; display: block; border-collapse: collapse; table-layout: fixed;width:100px;margin-left:-270px;">
                       <!-- Cities will be displayed here -->
                       </table>
                     </div>
                   <div id="citytable" style="margin-left:147px;margin-top:-300px;"></div>

                           <!-- Div to display role table information -->
                      <div id="roleTable" style="margin-left:220px;margin-top:-80px;"></div>
                      <!-- Table to display district information -->
                      <div id="districtInfo" style="display: none;"></div>
                        <table id="districtTable" class="datatablesSimples" border="1">
                            <tbody>
                      <!-- District information will be populated here -->
                   </tbody>
               </table>
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
     </div>
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
<script>

new DataTable('#example1');
new DataTable('#example2');


function fetchData() {
        // Fetch data using the Fetch API
        fetch('view_GP_level_details.php')
            .then(response => response.text())
            .then(data => {
                // Update the content container with the fetched data
                document.getElementById('result-container').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    function DhqData() {
        // Fetch data using the Fetch API
        fetch('view_vertical_zone_details.php')
            .then(response => response.text())
            .then(data => {
                // Update the content container with the fetched data
                document.getElementById('result-container').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    new DataTable('#zero_config');
$(document).ready(function() 
{
  $("#content").hide();
    $('#verticalView').click(function() {
        $("#content").show();
        $.ajax({
            url: 'getdistrict.php',
            type: 'GET',
            success: function(response) {
                $('#districttable').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log the error response
            }
        });
    });

    // Click event for districts
    $(document).on('click', '.city', function() {
        var districtId = $(this).data('districtid'); // Get the district ID from the clicked element
        console.log(districtId);
        if (districtId !== '') {
            $.ajax({
                url: 'getcities.php',
                type: 'GET',
                data: { districtId: districtId }, // Pass district ID to fetch cities
                success: function(response) {
                    $('#citytable').html(response);
                    $('#citytable').show(); // Show the cities when loaded
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log the error response
                }
            });
        }
    });

    // Click event for cities
    $(document).on('click', '.cityOne', function() {
        var cityId = $(this).data('cityid');
        console.log(cityId + ' Hello get vertical info');

        if (cityId !== '') {
            $.ajax({
                url: 'get_Vertical_Info.php',
                type: 'GET',
                data: { cityId: cityId },
                success: function(response) {
                    $('#roleTable').html(response);
                    $('#roleTable').show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});

    $(document).ready(function() {
    $('#horizontalView').click(function() {
        $("#content").hide();
        $("#districts").hide();
        $("#roleTable").hide();
        // $.ajax({
        //     url: 'getCities.php',
        //     type: 'GET',
        //     success: function(response) {
        //         $('#cititable').html(response);
        //     },
        //     error: function(xhr, status, error) {
        //         console.error(xhr.responseText); // Log the error response
        //     }
        // });
    });
});

</script>