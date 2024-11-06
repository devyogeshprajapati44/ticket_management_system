<?php
/* DHQ page. */
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
.dataTables_filter{
  margin-right: 32px;
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
</style>
        <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <!-- <h4 class="page-title">DHQ</h4> -->
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <!--<ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      TMS
                    </li>
                  </ol>-->
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
                <div class="col-12 specs_section">DHQ</div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered" style="margin-left:26px;margin-right:2px;width:97%;">
                      <thead>
                        <tr class="text-white" style="text-align:center;background-color:black;">
                          <th style="font-size: 11px;color:white;">Id</th>
                          <th style="font-size: 11px;color:white;">UserTag</th>
                          <th id="total" style="font-size: 11px;color:white;">Total Number of Devices</th>
                          <th style="font-size: 11px;text-align:center;color:white;">Status(High & Low)</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      //Total count of Connected and Not Connected of  all device like Router,Switches,CPU,Webcam Acc. to Site DHQ.
                            $sql_data="SELECT 
                            UserTags,
                            COUNT(*) AS Total_Count,
                            Status,
                            SUM(CASE WHEN Status = 'Low' THEN 1 ELSE 0 END) AS Low_Count,
                            SUM(CASE WHEN Status = 'High' THEN 1 ELSE 0 END) AS High_Count
                     FROM (
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_air_conditioner_240
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_desktop_computer_272
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_diesel_generator_272
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_idu_560
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_ip_camera_272
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_lnbc_560
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_modem_1731
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_odu_560
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_rack_3801
                         WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_ups_13142
                         WHERE UserTags = 'DHQ'

                         UNION ALL
                     
                        SELECT 'DHQ' AS UserTags, Status
                        FROM asset_network_router_switches_11813
                        WHERE UserTags = 'DHQ'
                     
                         UNION ALL
                     
                         SELECT 'DHQ' AS UserTags, Status
                         FROM asset_ip_phone_272
                         WHERE User_Tags = 'DHQ'
                     ) AS combined_tables
                     GROUP BY Status, UserTags
                     ORDER BY Status;";
                            $res = $connection->query($sql_data);
                        if ($res->num_rows > 0) 
                        {
                          $cnt=1;
                            while($row = $res->fetch_assoc()) 
                          {?>
                            <tr style="text-align:center;">
                            <td><?php echo $cnt++;?></td>
                            <td style="text-align:center;"><?php echo $row["UserTags"];?></td>
                                      <td style="text-align:center;"><?php echo $row["Total_Count"];?></td>
                                      <td style="text-align:center;"><?php echo $row["High_Count"].'<img src="assets/images/up_arrow.jpg" style="width:40px;height:31px;"/>'.'  '.$row["Low_Count"].'<img src="assets/images/red-arrow.png" style="width:14px;height:26px;margin-left:10px;margin-top:5px;"/>';?></td>
                            </tr>
                          <?php
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                 
                  </div>
                  <button id="horizontalView" class="btn btn-primary" style="width: 140px;">Horizontal view</button> 
                  <button id="verticalView"   class="btn btn-primary" style="width: 140px;">Vertical view</button> 
                  
                    <div id="content" style="margin-left:281px;margin-top:79px;display:none;">
                        <table id="districttable"  style="height:100px;border-collapse: collapse; table-layout: fixed;width:100px;margin-left:-270px;">
                       <!-- Cities will be displayed here -->
                       </table>
                       </div>
                   <div id="citytable"   style="margin-left:116px;margin-top:-100px;"></div>
                           <!-- Div to display role table information -->
                       <div id="roleTable" style="margin-left:220px;margin-top:-120px;"></div>
                      <!-- Table to display district information -->
                         <div id="districtInfo"  style="display: none;"></div>
                        
                          <table id="districtTable"  border="1" >
                            <tbody >
                                 <!-- District information will be populated here -->
                            </tbody>
                          </table>
                          
                    </div>
                 </div>
            </div>
<?php include 'footer.php';?>
  
<script type="text/Javascript">
//It will bind all the district and cities acc. to BHQ Site and user's Id.
new DataTable('#zero_config');
$(document).ready(function() 
{
  $("#content").hide();  
  $('#verticalView').click(function() {
        $("#content").show();
        $.ajax({
            url: 'getdistrict.php', //getdistrict.php.This page will fetch cities.
            type: 'GET',
            success: function(response) 
            {
                $('#districttable').html(response);
            },
            error: function(xhr, status, error) 
            {
                console.error(xhr.responseText); // Log the error response
            }
        });
    });

    // Click event for districts
    $(document).on('click', '.city', function() {
        var districtId = $(this).data('districtid'); // Get the district ID from the clicked element
        console.log(districtId);
        if (districtId !== '') 
        {
            $.ajax({
                url: 'getcities.php', //getcities.php.This page will fetch cities.
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
        var sites = 'DHQ';
        console.log(cityId + ' Hello get vertical info');

        if (cityId !== '') {
            $.ajax({
                url: 'get_Vertical_Info.php',  //get_Vertical_Info.This page will fetch data acc. to the cities.
                type: 'GET',
                data: { cityId: cityId, sites:sites },
                success: function(response) 
                {
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
</script>    
<script>
    $(document).ready(function() {
    $('#horizontalView').click(function() 
    {
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
