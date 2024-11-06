<?php

//Getting default page number

   
        if (isset($_GET['pageno'])) {

            $pageno = $_GET['pageno'];

        } else {

            $pageno = 1;

        }
// Formula for pagination  

        $no_of_records_per_page = 10;

        $offset = ($pageno-1) * $no_of_records_per_page;

// Getting total number of pages
?>
<?php 
function htmlContent($connection,$sql1,$no_of_records_per_page,$offset,$pageno){
if ($result = mysqli_query($connection, $sql1)) {

    // Return the number of rows in result set
    $total_rows = mysqli_num_rows( $result );
    $total_pages = ceil($total_rows / $no_of_records_per_page); 
   
}

?>

<?php if($_REQUEST['ticket_management_system']=="GetSHQ") { ?>
<h4><div align="center">

<ul class="pagination">

<?php  //echo $total_pages;?>

    <li><a href="GetSHQ.php&pageno=1" class="btn btn-primary">First</a>&nbsp;</li>

    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">

        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "GetSHQ.php&pageno=".($pageno - 1); } ?>" class="btn btn-primary">Prev</a>&nbsp;

    </li>

    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">

        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "GetSHQ.php&pageno=".($pageno + 1); } ?>" class="btn btn-primary">Next</a>&nbsp;

    </li>

    <li><a href="GetSHQ.php&pageno=<?php echo $total_pages; ?>" class="btn btn-primary">Last</a></li>

</ul>
</div></h4>
<?php } ?>
<!---New added on 11-09-2023--->

<?php
}
?>