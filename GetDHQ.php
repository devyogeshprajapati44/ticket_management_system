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
        <!-- ============================================================== -->
        <div class="container-fluid" style="margin-left:-40px;">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row" style="margin-right: -794px;">
            <div class="col-md-8">
              <div class="card" style="margin-bottom: 29px;">
                <div class="card-body">
                  <h5 class="card-title mb-0">DHQ</h5>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-bordered" style="margin-left:26px;margin-right:2px;width:97%;">
                      <thead>
                        <tr class="text-white" style="text-align:center;background-color:black;">
                        <th class="text-white">Id</th>
                        <th class="text-white">Asset ID</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Owners</th>
                        <th class="text-white">Requesters</th>
                        <th class="text-white">UserTags</th>
                        <th class="text-white">Asset Tags</th>
                        <th class="text-white">Location</th>
                        <th class="text-white">City</th>
                        <th class="text-white">District</th>
                        <th class="text-white">Location State</th>
                        <th class="text-white">Asset State</th>
                        <th class="text-white">Agent Name</th>
                        <th class="text-white">Category</th>
                        <th class="text-white">State</th>
                        <th class="text-white">Serial Number</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Criticality</th>
                        <th class="text-white">Service Status</th>
                        <th class="text-white">Operational Status</th>
                        <th class="text-white">Business Function</th>
                        <th class="text-white">Description</th>
                        <th class="text-white">Installation Date</th>
                        <th class="text-white">Usage Type</th>
                        <th class="text-white">State Change Reason</th>
                        <th class="text-white">Retire Reason</th>
                        <th class="text-white">Make</th>
                        <th class="text-white">Model</th>
                        <th class="text-white">Manufacturer</th>
                        <th class="text-white">Domain</th>
                        <th class="text-white">Series</th>
                        <th class="text-white">Vendor</th>
                        <th class="text-white">Tag No</th>
                        <th class="text-white">Uninstall date</th>
                        <th class="text-white">Branch code</th>
                        <th class="text-white">Branch name</th>
                        <th class="text-white">Invoice No</th>
                        <th class="text-white">Part No</th>
                        <th class="text-white">Cost</th>
                        <th class="text-white">Purchase date</th>
                        <th class="text-white">Depreciation Type</th>
                        <th class="text-white">Salvage Value</th>
                        <th class="text-white">Currency</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      //Total count of Connected and Not Connected of  all device like Router,Switches,CPU,Webcam Acc. to Site DHQ.
                      if(isset($_GET['city']))
                      {
                        
                        $cityName = $_GET['city'];

                        $sql_data="SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM (
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM asset_air_conditioner_240
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM asset_desktop_computer_272
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM `asset_diesel_generator_272`
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM `asset_idu_560`
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM `asset_ip_camera_272`
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM `asset_lnbc_560`
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM `asset_modem_1731`
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM `asset_odu_560`
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM `asset_rack_3801`
                        WHERE City = '$cityName'
                        UNION
                        SELECT `Id`, `Asset ID`, `Name`, `Owners`, `Requesters`, `UserTags`, `Asset Tags`, 
                        `Location`, `City`, `District`, `Location State`, `Asset State`, `Agent Name`, 
                        `Category`, `State`, `Serial Number`, `Status`, `Criticality`, `Service Status`, 
                        `Operational Status`, `Business Function`, `Description`, `Installation Date`, 
                        `Usage Type`, `State Change Reason`, `Retire Reason`, `Make`, `Model`, 
                        `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag No`, `Uninstall date`, 
                        `Branch code`, `Branch name`, `Invoice No`, `Part No`, `Cost`, `Purchase date`, 
                        `Depreciation Type`, `Salvage Value`, `Currency`
                        FROM `asset_ups_13142`
                        WHERE City = '$cityName'
                        -- Add similar SELECT statements for other tables
                        UNION
                        SELECT `Id`, `Asset_ID`, `Name`, `Owners`, `Requesters`, `User_Tags`, `Asset_Tags`, `Location`, `City`, `District`, `Location_State`, `Asset_State`, `Agent_Name`, `Category`, `State`, `Serial_Number`, `Status`, `Criticality`, `Service_Status`, `Operational_Status`, `Business_Function`, `Description`, `Installation_Date`, `Usage_Type`, `State_Change_Reason`, `Retire_Reason`, `Make`, `Model`, `Manufacturer`, `Domain`, `Series`, `Vendor`, `Tag_No`, `Uninstall_Date`, `Branch_Code`, `Branch_Name`, `Invoice_No`, `Part_No`, `Cost`, `Purchase_Date`, `Depreciation_Type`, `Salvage_Value`, `Currency`
                        FROM asset_ip_phone_272
                        WHERE City = '$cityName'
                        ) AS combined_tables
                        WHERE UserTags='DHQ'";
                      }
                            $res = $connection->query($sql_data);
                        if ($res->num_rows > 0) 
                        {
                          $cnt=1;
                            while($row = $res->fetch_assoc()) 
                          {?>
                            <tr style="text-align:center;">
                            <td><?php echo $cnt++;?></td>
                            <td><?php echo $row["Asset ID"]; ?></td>
                            <td><?php echo $row["Name"]; ?></td>
                            <td><?php echo $row["Owners"]; ?></td>
                            <td><?php echo $row["Requesters"]; ?></td>
                            <td><?php echo $row["UserTags"]; ?></td>
                            <td><?php echo $row["Asset Tags"]; ?></td>
                            <td><?php echo $row["Location"]; ?></td>
                            <td><?php echo $row["City"]; ?></td>
                            <td><?php echo $row["District"]; ?></td>
                            <td><?php echo $row["Location State"]; ?></td>
                            <td><?php echo $row["Asset State"]; ?></td>
                            <td><?php echo $row["Agent Name"]; ?></td>
                            <td><?php echo $row["Category"]; ?></td>
                            <td><?php echo $row["State"]; ?></td>
                            <td><?php echo $row["Serial Number"]; ?></td>
                            <td><?php echo $row["Status"]; ?></td>
                            <td><?php echo $row["Criticality"]; ?></td>
                            <td><?php echo $row["Service Status"]; ?></td>
                            <td><?php echo $row["Operational Status"]; ?></td>
                            <td><?php echo $row["Business Function"]; ?></td>
                            <td><?php echo $row["Description"]; ?></td>
                            <td><?php echo $row["Installation Date"]; ?></td>
                            <td><?php echo $row["Usage Type"]; ?></td>
                            <td><?php echo $row["State Change Reason"]; ?></td>
                            <td><?php echo $row["Retire Reason"]; ?></td>
                            <td><?php echo $row["Make"]; ?></td>
                            <td><?php echo $row["Model"]; ?></td>
                            <td><?php echo $row["Manufacturer"]; ?></td>
                            <td><?php echo $row["Domain"]; ?></td>
                            <td><?php echo $row["Series"]; ?></td>
                            <td><?php echo $row["Vendor"]; ?></td>
                            <td><?php echo $row["Tag No"]; ?></td>
                            <td><?php echo $row["Uninstall date"]; ?></td>
                            <td><?php echo $row["Branch code"]; ?></td>
                            <td><?php echo $row["Branch name"]; ?></td>
                            <td><?php echo $row["Invoice No"]; ?></td>
                            <td><?php echo $row["Part No"]; ?></td>
                            <td><?php echo $row["Cost"]; ?></td>
                            <td><?php echo $row["Purchase date"]; ?></td>
                            <td><?php echo $row["Depreciation Type"]; ?></td>
                            <td><?php echo $row["Salvage Value"]; ?></td>
                            <td><?php echo $row["Currency"]; ?></td>
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
<?php //include 'footer.php';?>


<script type="text/Javascript">
//It will bind all the district and cities acc. to BHQ Site and user's Id.
new DataTable('#zero_config');
</script>    

