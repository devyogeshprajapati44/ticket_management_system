<?php
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';
// Check if the user is not logged in, redirect to login page



$query = "SELECT * FROM `rajnet` WHERE `r_id`='1';";
$fetch = mysqli_query($connection,$query);
$row = $fetch->fetch_assoc();
$Id=$row["r_id"];

//Ticket Details.
$query_ticket="SELECT * FROM `complaints` order by `Id` DESC";
$fetch_ticket = mysqli_query($connection,$query_ticket);
$row_tickt = $fetch_ticket->fetch_assoc();
//$Id=$row["r_id"];
//Ticket Details.
?>



<div class="row">     
<?php
if(isset($_REQUEST["Mgs"])){
    $Mgs=$_REQUEST["Mgs"];
    if($Mgs==1){
        ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align:center;">
      <strong><i class="bi bi-check"></i> Success !</span><?php echo $_REQUEST['message'].' and You Complaint Number is <b style="color:blue;">'.$_REQUEST['complaint_number'].'</b>';?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
    }
}
?> 
<style>
    table td {
    border-bottom: 1px solid #e6e6e6;
    color: #191919;
    text-align: inherit;
    padding: 2px 2px;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
.style8 {
    width: 400px;
    height: 1px;
    border-bottom-color: #63ace5;
    font-weight: bold;
    font-family: Calibri;
    font-size: small;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
table td {
    color: #191919;
    text-align: inherit;
    padding: 2px 2px;
}
.style9 {
    width: 400px;
    height: 1px;
border-bottom-color: #63ace5;
}
.HeaderStyle {
    background-color: #63ace5;
    font-size: large;
    font-weight: bold;
}
.TableStyle {
    border-bottom-color: #63ace5;
    border-left-color: #63ace5;
    border-top-color: #63ace5;
    border-right-color: #63ace5;
}
table {
    border: 1px solid #f0f0f0;
    margin: 0 0 20px;
}
</style>     

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
            <span id="ctl00_ContentPlaceHolder1_lblsiteactivestatusHeader" style="color:Green;font-size:X-Large;font-weight:bold;">GP Level</span>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- BACK BUTTON -->
          <form method="POST">
               <a class="btn btn-warning text-black" href="dashboard.php"  style="margin:4px;font-size:large;height:37px;padding:3px;width:100px;margin-left:7px;" role="button">Back</a>&nbsp;&nbsp;
            </form>
          <!-- ====================TABLE============================== -->
          <div class="row" style="margin-right: -547px;">
            <div class="col-md-8">
              <div class="card" style="margin-bottom: 29px;">
                <div class="card-body">
                    <!-- ==========HQ Details================= -->
                 <table width="100%" style="margin-left:0px;">
                    <tbody><tr>
                       <td>
                         <div style="background-color: #63ace5;">
                            <center>
                                
                            <span id="ctl00_ContentPlaceHolder1_Label12" class="HeaderStyle">HQ Details</span></center>
                              </div>
                                    <table width="100%" class="TableStyle">
                                        <tbody><tr>
                                            <td class="style8">
                                            UID
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblGP"><?php echo $row["Unique_Code"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                           Gram Panchayat Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbluniquecode"><?php echo $row["GP_Name"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Type_Of_Site 
                                        </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldivision"><?php echo $row["Type_Of_Site"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Zone
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldistrict"><?php echo $row["Zone"];?></span>
                                            </td>
                                        </tr>
                                            <td class="style8">
                                            District
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldistrict"><?php echo $row["District"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Dist LGD Code
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblPS"><?php echo $row["Dist_LGD_Code"];?></span>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                     <!-- ==========HQ Status================= -->
                                <td>
                                    <div style="background-color: #63ace5;">
                                        <center>
                                            <span id="ctl00_ContentPlaceHolder1_Label11" class="HeaderStyle">HQ Status</span></center>
                                    </div>
                                    <table width="100%" class="TableStyle">
                                        
                                        <tbody><tr>
                                            <td class="style8">
                                            GP LGD Code Gov
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblGP"><?php echo $row["GP_LGD_Code_Govt"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            GP Code Govt
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbluniquecode"><?php echo $row["GP_Code_Govt"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            PS LGD Code
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblPS"><?php echo $row["PS_LGD_Code"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Type Of Connectivity   
                                        </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldivision"><?php echo $row["Type_Of_Connectivity"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Idu status
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblPS"><?php echo $row["idu_status"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Odu status
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblPS"><?php echo $row["odu_status"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                    </tbody></table>
                            </td>
                            </tr>
                             <!-- ==========Technical Details================= -->
                            <tr>
                                <td colspan="4">
                                    <div style="background-color: #63ace5;">
                                        <center>
                                            <span id="ctl00_ContentPlaceHolder1_Label1" class="HeaderStyle">Technical Details</span></center>
                                    </div>
                                    <table width="100%" class="TableStyle">
                                        <tbody>
                                        <tr>
                                            <td class="style8">
                                            Gateway Ip
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldistrict"><?php echo $row["Gateway_Ip"];?></span>
                                            </td>
                                            <td class="style8">
                                            Antenna
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblLatitude"><?php echo $row["Antenna"];?></span>
                                            </td>
                                        </tr>    
                                        <tr>
                                            <td class="style8">
                                            Switch
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbllongitude"><?php echo $row["Switch"];?></span>
                                            </td>
                                            <td class="style8">
                                            Router
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblvsatid"><?php echo $row["Router"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            UPS
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblipaddress"><?php echo $row["UPS"];?></span>
                                            </td>
                                            <td class="style8">
                                            Battery Quantity
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblsubnetmask"><?php echo $row["Battery_Quantity"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Patch chord Quantity
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldnsserver"><?php echo $row["Patch_chord_quantity"];?></span>
                                            </td>
                                            <td class="style8">
                                            IO Port quantity
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblkioskno"><?php echo $row["IO_Port_quantity"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Monkey Detterent
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblSwitchip"><?php echo $row["Monkey_detterent"];?></span>
                                            </td>
                                            <td class="style8">
                                            Monkey Detterent Go Live Count
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblusableiprange"><?php echo $row["Monkey_detterent_Go_Live_Count"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td class="style8">
                                            Earthing
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblcontactno"><?php echo $row["Earthing"];?></span>
                                            </td>
                                            <td class="style8">
                                            Lan
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbllpsname"><?php echo $row["Lan"];?></span>
                                            </td>
                                            <tr>
                                            <td class="style8">
                                            Rack
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblcontactpersion"><?php echo $row["Rack"];?></span>
                                            </td>
                                            <td class="style8">
                                            Rack Serial No
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblEmailID"><?php echo $row["Rack"];?></span>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="style8">
                                            Remark
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblemitracontactpersion"><?php echo $row["Remark"];?></span>
                                            </td>
                                            </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                  <!-- ==========Ticket Details================= -->
                            <tr>
                                <td colspan="4">
                                    <div style="background-color: #63ace5;">
                                        <center>
                                            <span id="ctl00_ContentPlaceHolder1_Label8" class="HeaderStyle">Ticket Details</span></center>
                                    </div>
                                    <table width="100%" class="TableStyle">
                                        <tbody><tr>
                                            <td class="style8">
                                            Ticket ID
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblcalledDate"><?php echo $row_tickt["complaint_number"];?></span>
                                            </td>
                                            <td class="style8">
                                            Ticket Status
                                            </td>
                                             <td class="style9">
                                              <span id="ctl00_ContentPlaceHolder1_lblCalledBy"><?php echo $row_tickt["complaint_status"];?></span>
                                            </td>
                                         </tr>
                                         <tr>
                                            <td class="style8">
                                            Ticket Date
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblcalledDate"><?php echo $row_tickt["complaint_register_date"];?></span>
                                            </td>
                                            <td class="style8">
                                            Ticket Remarks
                                            </td>
                                             <td class="style9">
                                              <span id="ctl00_ContentPlaceHolder1_lblCalledBy"><?php echo $row_tickt["complaint_remarks"];?></span>
                                            </td>
                                         </tr>

                                    </tbody></table>
                                </td>
                            </tr>
                         </tbody></table>
                           <!-- ====================TABLE============================== -->
 <!-- ====================ADD TICKETD MODAL============================== -->                      
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="margin-left:0px;width: 120px;">+ Add Ticket</button>
</span></div> </div> </div>
    <!-- ADD Modal -->
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <Form  action="complaint_register_api.php?ID=<?php echo $Id;?>&type=GPLevel"  method="POST" >
                <input type="hidden" name="Id" id="Id" value="<?php echo $Id;?>"/>
                   <div class="modal-header">
                    <legend class="card-title"  id="myModalLabel" style="color:#012970;">Register Your Compliant Here (GP Level)</legend>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Divison Code" name="divison_code" id="divison_code" value="<?php echo $Id;?>">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                        </div>
                       </div>
                       <div class="input-group mb-3">
                         <textarea class="form-control" placeholder="complaint_remarks" name="complaint_remarks" id="complaint_remarks"></textarea>
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-comments"></span>
                             </div>
                            </div>
                          </div>
                        </div>
                       <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-bs-dismiss="modal" value="Cancel">
                     <input  type="submit" name="submit" id="submit" class="btn btn-primary">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- ====================ADD TICKETD MODAL============================== -->   
      </div>
    </div>
  </div>
<!-- =========footer============== -->
<?php include 'footer.php';?>
<!-- =========footer============== -->


