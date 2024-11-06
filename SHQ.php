<?php
/* SHQ page. */
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';
?>

<style>
    .datatablesSimples,table, th, td 
    {
      border: 1px solid black;
      border-collapse: collapse;
      background: white;
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
    
    .specs_section {
    background-color: #EEE;
    border-bottom: #DADADA 1px solid;
    padding: 10px;
    color: #CA4544;
    text-transform: uppercase;
    font-size: 0.9em;
    font-weight: 700;
    letter-spacing: 0.05em;
    margin-top: 10px;
}
.dataTables_filter{
  margin-right: 32px;
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
              <!-- <h4 class="page-title">SHQ</h4> -->
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
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row" style="margin-right: -794px;">
            <div class="col-md-8">
              <div class="card" style="margin-bottom: 29px;">
                <div class="card-body">
                  <!-- <h5 class="card-title mb-0">SHQ</h5> -->
                  <div class="col-12 specs_section">SHQ</div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table" style="margin-left:26px;margin-right:2px;width:97%;">
                      <thead>
                        <tr class="text-white" style="text-align:center;background-color:black;">
                            <th class="text-white">Id</th>
                            <th class="text-white">Segment</th>
                            <th class="text-white">Number</th>
                            <th class="text-white">Router</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Switch</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">CPU</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">webcam</th>
                            <th class="text-white">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                            //Total count of Connected and Not Connected of  all device like Router,Switches,CPU,Webcam Acc. to Site SHQ.
                            $sql_data="SELECT 
                            `segment` AS 'Segment',
                            COUNT(*)  AS 'Total_Count',
                            MAX(CASE WHEN `devices` = 'Router' THEN 'Router' END) AS 'Router',
                            SUM(CASE WHEN `devices` = 'Router' AND `status` = 'connected' THEN 1 ELSE 0 END) AS 'Router_Connected',
                            SUM(CASE WHEN `devices` = 'Router' AND `status` = 'Not connected' THEN 1 ELSE 0 END) AS 'Router_Not_Connected',
                            
                            MAX(CASE WHEN `devices` = 'switch' THEN 'Switches' END) AS 'Switches',
                            SUM(CASE WHEN `devices` = 'switch' AND `status` = 'connected' THEN 1 ELSE 0 END) AS 'Switches_Connected',
                            SUM(CASE WHEN `devices` = 'switch' AND `status` = 'Not connected' THEN 1 ELSE 0 END) AS 'Switches_Not_Connected',
                            
                            MAX(CASE WHEN `devices` = 'CPU' THEN 'CPU' END) AS 'CPU',
                            SUM(CASE WHEN `devices` = 'CPU' AND `status` = 'connected' THEN 1 ELSE 0 END) AS 'CPU_Connected',
                            SUM(CASE WHEN `devices` = 'CPU' AND `status` = 'Not connected' THEN 1 ELSE 0 END) AS 'CPU_Not_Connected',
                            
                            MAX(CASE WHEN `devices` = 'Webcam' THEN 'Webcam' END) AS 'Webcam',
                            SUM(CASE WHEN `devices` = 'Webcam' AND `status` = 'connected' THEN 1 ELSE 0 END) AS 'Webcam_Connected',
                            SUM(CASE WHEN `devices` = 'Webcam' AND `status` = 'Not connected' THEN 1 ELSE 0 END) AS 'Webcam_Not_Connected',
                        
                            SUM(CASE WHEN `segment` = 'DHQ' THEN 1 ELSE 0 END)  AS 'DHQ_Count',
                            SUM(CASE WHEN `segment` = 'BHQ' THEN 1 ELSE 0 END)  AS 'BHQ_Count',
                            SUM(CASE WHEN `segment` = 'SHQ' THEN 1 ELSE 0 END)  AS 'SHQ_Count',
                            SUM(CASE WHEN `segment` = 'GP'  THEN 1 ELSE 0 END)  AS 'GP_Count'
                        FROM 
                            `segment`  where segment = 'SHQ'
                        GROUP BY 
                            segment";
                            $res = $connection->query($sql_data);
                        if ($res->num_rows > 0) 
                        {
                          $cnt=1;
                            while($row = $res->fetch_assoc()) 
                          {?>
                            <tr style="text-align:center;">
                            <td><?php echo $cnt++;?></td>
                            <td><?php echo $row["Segment"];?></td>
                            <td><?php echo $row["Total_Count"];?></td>
                            <td><?php echo $row["Router"];?></td>
                            <td><?php echo $row["Router_Connected"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["Router_Not_Connected"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                            <td><?php echo $row["Switches"];?></td>
                            <td><?php echo $row["Switches_Connected"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["Switches_Not_Connected"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                            <td><?php echo $row["CPU"];?></td>
                            <td><?php echo $row["CPU_Connected"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["CPU_Not_Connected"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                            <td><?php echo $row["Webcam"];?></td>
                            <td><?php echo $row["Webcam_Connected"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["Webcam_Not_Connected"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                            </tr>
                          <?php
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                 
                  </div>
                  <button id="horizontalView" class="btn btn-primary" style="width: 140px;" >Horizontal view</button> 
                  <button id="verticalView"   class="btn btn-primary" style="width: 140px;">Vertical view</button> 
                  
                  <div id="content" style="margin-left: 306px;margin-top: 79px;display:none;">
                        <table id="districttable" style="height: 100px;border-collapse: collapse;width: 100px;margin-left: -270px;">
                       <!-- Cities will be displayed here -->
                       </table>
                     </div>
                     <div id="citytable"   style="margin-left:141px;margin-top:-100px;"></div>
                           <!-- Div to display role table information -->
                       <div id="roleTable" style="margin-left:220px;margin-top:-120px;"></div>
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
</div>
<!-- =========footer============== -->
<?php include 'footer.php';?>
  <!-- =========footer============== -->
  
<script type="application/javascript">
//It will bind all the district and cities acc. to SHQ Site and user's Id.
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
        var sites = 'SHQ';
        console.log(cityId + ' Hello get vertical info');

        if (cityId !== '') {
            $.ajax({
                url: 'get_Vertical_Info.php',
                type: 'GET',
                data: { cityId: cityId, sites:sites },
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
