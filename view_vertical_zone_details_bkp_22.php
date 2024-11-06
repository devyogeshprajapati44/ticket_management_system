<?php
error_reporting(0);
session_start();
include 'PFC.php';
include 'connection.php';
include 'sidebar.php';
include 'complaint_register_api.php';
session_start();
if (!isset($_SESSION['PFC_UID'])) 
{
    header("location:Login.php");
    //die();
}

if(!defined('MY_HEADER'))
{
header('Location:Login.php');
}

$ID=$_REQUEST["ID"];

$query = "SELECT * FROM `dhq_inventory_with_assetid` WHERE `Id` = '$ID'";
$fetch = mysqli_query($connection, $query);
$row = $fetch->fetch_assoc();
$Id=$row["Id"];
$District_code=$row["District_Code"];

//Ticket Details.
$query_ticket="SELECT * FROM `complaints` order by `Id` DESC";
$fetch_ticket = mysqli_query($connection,$query_ticket);
$row_tickt = $fetch_ticket->fetch_assoc();
//$Id=$row["r_id"];
//Ticket Details.
?>

<style>
  body {
    font-family: "Open Sans", sans-serif;
    background: #f6f9ff;
    color: #444444;
}
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
.select2-container--default .select2-selection--multiple .select2-selection__choice{
      padding-left: 29px;
      background-color: #e4e4e4;
      color: #160d0d;
    }
</style>

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
<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
            <span id="ctl00_ContentPlaceHolder1_lblsiteactivestatusHeader" style="color:Green;font-size:X-Large;font-weight:bold;">H.Q LEVEL</span>
            
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
               <a class="btn btn-warning text-black" href="Report_1.php?DID=103"  style="margin:4px;font-size:large;height:37px;padding:3px;width:100px;margin-left:7px;" role="button">Back</a>&nbsp;&nbsp;
            </form>
         
          <div class="row" style="margin-right:-531px">
            <div class="col-md-8">
              <div class="card" style="margin-bottom: 29px;">
                <div class="card-body">
                <table width="100%" style="margin-left:0;" >
                    <tbody><tr>
                    <td>
                       <div style="background-color: #63ace5;">
                         <center>
                            <span id="ctl00_ContentPlaceHolder1_Label12" class="HeaderStyle">HQ Details</span></center>
                         </div>
                                    
                                    <table width="100%" class="TableStyle">
                                        
                                        <tbody><tr>
                                            <td class="style8">
                                            POP_Code
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblGP"><?php echo $row["Vertical_POP_Code"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Division Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbluniquecode"><?php echo $row["Division_Name"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Division Code                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldivision"><?php echo $row["Division_Code"];?></span>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="style8">
                                                District Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldistrict"><?php echo $row["District_Name"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            District Code
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblPS"><?php echo $row["District_Code"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Block Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblGP"><?php echo $row["Block_Name"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Block Code
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbluniquecode"><?php echo $row["Block_Code"];?></span>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td>
                                   
                                </td>
                            </tr>
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
                                            Router Host Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblPS"><?php echo $row["Router_Host_Name"];?></span>
                                            </td>
                                            <td class="style8">
                                            Router For Vertical Site Serial No
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblPS"><?php echo $row["Router_For_Vertical_Site_Serial_No"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Vertical PoP Level                                            
                                           </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldivision"><?php echo $row["Vertical_PoP_Level"];?></span>
                                            </td>
                                            <td class="style8">
                                              POP Location
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldistrict"><?php echo $row["POP_Location"];?></span>
                                            </td>
                                        </tr>
                                            <tr>
                                            <td class="style8">
                                            Router For Vertical Site Qty
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblLatitude"><?php echo $row["Router_For_Vertical_Site_Qty"];?></span>
                                            </td>
                                            <td class="style8">
                                            Router Asset ID
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblPS"><?php echo $row["Router_Asset_ID"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            LAN Switch For Vertical Site Serial No.
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblvsatid"><?php echo $row["LAN_Switch_For_Vertical_Site_Serial_No"];?></span>
                                            </td>
                                            <td class="style8">
                                            LAN Switch For Vertical Site Qty
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblipaddress"><?php echo $row["LAN_Switch_For_Vertical_Site_Qty"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            CPU Host Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblsubnetmask"><?php echo $row["CPU_Host_Name"];?></span>
                                            </td>
                                            <td class="style8">
                                            CPU Asset ID
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbldnsserver"><?php echo $row["CPU_Asset_ID"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            CPU Serial No
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblSwitchip"><?php echo $row["CPU_Serial_No"];?></span>
                                            </td>
                                            <td class="style8">
                                            CPU Qty
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblusableiprange"><?php echo $row["CPU_Qty"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Rack Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblemitracontactpersion"><?php echo $row["Rack_Name"];?></span>
                                            </td>
                                            <td class="style8">
                                            Rack Asset ID
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblemitracontactno"><?php echo $row["Rack_Asset_ID"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Rack Serial No
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblEmailID"><?php echo $row["Rack_Serial_No"];?></span>
                                            </td>
                                             <td class="style8">
                                             Rack Qty
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbl_ip_phno"><?php echo $row["Rack_Qty"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            DG Set Host Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblcalledDate"><?php echo $row["DG_Set_Host_Name"];?></span>
                                            </td>
                                            <td class="style8">
                                            DG Set Asset ID
                                            </td>
                                             <td class="style9">
                                              <span id="ctl00_ContentPlaceHolder1_lblCalledBy"><?php echo $row["DG_Set_Asset_ID"];?></span>
                                            </td>
                                         </tr>
                                         <tr>
                                            <td class="style8">
                                            DG Set Serial No
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblcalledDate"><?php echo $row["DG_Set_Serial_No"];?></span>
                                            </td>
                                            <td class="style8">
                                            DG Set Qty
                                            </td>
                                             <td class="style9">
                                              <span id="ctl00_ContentPlaceHolder1_lblCalledBy"><?php echo $row["DG_Set_Qty"];?></span>
                                            </td>
                                         </tr>
                                        <tr>
                                        <td class="style8">
                                           Switch Asset ID
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbllongitude"><?php echo $row["Switch_Asset_ID"];?></span>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div style="background-color: #63ace5;">
                                        <center>
                                            <span id="ctl00_ContentPlaceHolder1_Label4" class="HeaderStyle">WebCam Details</span></center>
                                    </div>
                                    <table width="100%" class="TableStyle">
                                        <tbody><tr>
                                            <td class="style8">
                                            Webcam Host Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblcontactpersion"><?php echo $row["Webcam_Host_Name"];?></span>
                                            </td>
                                            <td class="style8">
                                            Webcam Asset ID
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblcontactno"><?php echo $row["Web_cam_Asset_ID"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            Webcam with Webbased Surveillance Software Serial No
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lbllpsname"><?php echo $row["Webcam_with_Web_based_Surveillance_Software_Serial_No"];?></span>
                                            </td>
                                            <td class="style8">
                                            Webcam with Webbased Surveillance Software Qt
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblkioskno"><?php echo $row["Webcam_with_Web_based_Surveillance_Software_Qty"];?></span>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div style="background-color: #63ace5;">
                                        <center>
                                            <span id="ctl00_ContentPlaceHolder1_Label7" class="HeaderStyle">UPS Details</span></center>
                                    </div>
                                    <table width="100%" class="TableStyle">
                                        <tbody><tr>
                                            <td class="style8">
                                            UPS Host Name
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblsolarlightavbl"><?php echo $row["UPS_Host_Name"];?></span>
                                            </td>
                                            <td class="style8">
                                            UPS Asset ID
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblsolarlightremarks"><?php echo $row["UPS_Asset_ID"];?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                            UPS Serial No
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblElectricityworking"><?php echo $row["UPS_Serial_No"];?></span>
                                            </td>
                                            <td class="style8">
                                            UPS Qty
                                            </td>
                                            <td class="style9">
                                                <span id="ctl00_ContentPlaceHolder1_lblelectricityremarks"><?php echo $row["UPS_Qty"];?></span>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                <td colspan="4">
                                    <div style="background-color: #63ace5;">
                                       
                                            <span id="ctl00_ContentPlaceHolder1_Label8" class="HeaderStyle">Ticket Details</span>
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
                                </td>
                            </tr>                            
                        </tbody></table>
                          <!-- ====================TABLE============================== -->
 <!-- ====================ADD TICKETD MODAL============================== -->                      
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="margin-left:1px;">+ Add Ticket</button>
                        </span></div> </div> </div>
                            <!-- ADD Modal -->
                            <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-lg">
                                 <div class="modal-content">
                                   <Form  action="complaint_register_api.php?DID=<?php echo $Id;?>&type=HQLevel"  method="POST">
                                   <input type="hidden" name="ID" id="ID" value="<?php echo $Id;?>"/>
                                        <div class="modal-header">
                                          <legend class="card-title"  id="myModalLabel" style="color:#012970;">Register Your Compliant Here (HQ Level)</legend>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                           <div class="row">
                                            <div class="col-12">
                                            <select  class="SelectEmp form-select" name="Router_Asset_ID[]" onclick="emp_multiple_select()" id="Router_Asset_ID"  style="width: 743.75px;" multiple/>
                                                <option value="NA">--Select Asset--</option>
                                                <?php
                                                $sql="SELECT * FROM dhq_inventory_with_assetid";
                                                $result = $connection->query($sql);

                                                if ($result->num_rows > 0) 
                                                {
                                                while($row = $result->fetch_assoc()) 
                                                    {?>
                                                <option value="<?php echo $row['Id'];?>"><?php echo $row['Router_Asset_ID'];?></option>
                                                <?php 
                                                    }
                                                }
                                                ?>
                                            </select>
                                            </div>
                                           </div><br><br>

                                           <div class="row">
                                            <div class="col-6">
                                            <label for="text" class="form-label">Date <span style="color:red">*</span></label>
                                             <input type="date"  class="complaint_register_date form-control"  name="complaint_register_date" required>
                                            </div>
                                            <div class="col-6">
                                            <label for="text" class="form-label">SELECT STATUS<span style="color:red">*</span></label>
                                               <select name="complaint_status" class=" form-control" id="complaint_status">
                                                    <option value="NA">--SELECT STATUS--</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Reject">Reject</option>
                                               </select>
                                            </div>
                                           </div><br><br><br>

                                            <div class="input-group mb-3">
                                                <textarea class="form-control" placeholder="Complaint Remarks" name="complaint_remarks" id="complaint_remarks"></textarea>
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
<script type="text/javascript">
        function emp_multiple_select()
        {
          $(document).ready(function () 
          {
            $('.SelectEmp').select2();
          });
        }
</script>