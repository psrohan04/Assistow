<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['vamsaid']==0)) {
    header('location:logout.php');
} else {

    // Code for deleting tow truck
    if(isset($_GET['delid'])) {
        $rid=intval($_GET['delid']);
        $sql="DELETE FROM tbltowtruck WHERE ID=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Data deleted');</script>"; 
        echo "<script>window.location.href = 'manage-towtruck.php'</script>";
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>Vehicle Break Down Assistance Management System: Manage Tow Trucks</title>
    <link rel="stylesheet" href="../assets/vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body class="theme-indigo">

<?php include_once('includes/header.php');?>

<div class="main_content" id="main-content">
    <?php include_once('includes/sidebar.php');?>

    <div class="page">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="javascript:void(0);">Manage Tow Trucks</a>
        </nav>
        <div class="container-fluid">            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Manage</strong> Tow Trucks</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Truck ID</th>
                                            <th>Company Name</th>
                                            <th>Contact Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Services Offered</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql="SELECT * FROM tbltowtruck";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt=1;
                                        if($query->rowCount() > 0) {
                                            foreach($results as $row) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php echo htmlentities($row->TruckID);?></td>
                                                    <td><?php echo htmlentities($row->CompanyName);?></td>
                                                    <td><?php echo htmlentities($row->ContactName);?></td>
                                                    <td><?php echo htmlentities($row->Phone);?></td>
                                                    <td><?php echo htmlentities($row->Email);?></td>
                                                    <td><?php echo htmlentities($row->Location);?></td>
                                                    <td><?php echo htmlentities($row->Services);?></td>
                                                    <td>
                                                        <a href="edit-towtruck-detail.php?editid=<?php echo htmlentities($row->ID);?>">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a> || 
                                                        <a href="manage-towtruck.php?delid=<?php echo htmlentities($row->ID);?>" onclick="return confirm('Do you really want to Delete ?');">
                                                            <i class="fa fa-trash fa-delete" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php $cnt=$cnt+1; } 
                                        } ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>

<!-- Jquery Core Js --> 
<script src="../assets/bundles/libscripts.bundle.js"></script>
<script src="../assets/bundles/vendorscripts.bundle.js"></script>
<!-- Jquery DataTable Plugin Js --> 
<script src="../assets/bundles/datatablescripts.bundle.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="../assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="../assets/js/theme.js"></script>
<script src="../assets/js/pages/tables/jquery-datatable.js"></script>
</body>
</html>
<?php } ?>
