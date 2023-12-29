<?php
include '../server.php';

if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}

//deny access to courses.php if user is not an admin
if (!isset($_SESSION['role_name']) || ($_SESSION['role_name'] !== 'Chairperson' && $_SESSION['role_name'] !== 'Dean' && $_SESSION['role_name'] !== 'Lecturer')) {
    // if the session variable 'role_name' is not set or does not equal 'Chairperson', 'Dean', or 'Lecturer', deny access and redirect to a non-privileged page
    header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
    exit;
  }

$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

  // Deselect unit
if (isset($_POST['delete-unit-btn'])) {
  if ($_SESSION['role_name'] == 'Chairperson'||$_SESSION['role_name'] == 'Lecturer'||$_SESSION['role_name'] == 'Dean'){
  $unitID = $_POST['unit_id'];
  
  if (empty($unitID)) {
    array_push($errors, "Unit ID is required");
  }
  if (count($errors) == 0) {
      $unit_data_delete_query = "DELETE FROM `lecturer_unit_details` WHERE unit_id='$unitID' AND lecturer_id ='$pfno'";
      $results = mysqli_query($db, $unit_data_delete_query);

        header('location: selected-units.php');
      }else{
        array_push($errors, "Unable to delete this unit");
        header('location: selected-units.php');
      }
  }
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Selected Units| EDUTIME</title>
    <?php
include '../assets/components/header.php';
?>
</head>

<body>

    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <?php
     include '../assets/components/topbar.php';
     ?>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->


    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <?php
     include '../assets/components/sidebar.php';
     ?>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb pt-5">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Units Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Units
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
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Units You Selected:</h5>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Unit ID</th>
                                        <th>Unit Name</th>
                                        <th>Unit Type</th>
                                        <th>Course</th>
                                        <th>Group</th>
                                        <th>Semester</th>
                                        <th>Date Selected</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  if(!isset($_SESSION['role_name']) || ($_SESSION['role_name'] !== 'Chairperson' || $_SESSION['role_name'] !== 'Dean' || $_SESSION['role_name'] !== 'Lecturer')){
      $data_fetch_query = "SELECT * FROM `lecturer_unit_details`
      INNER JOIN unit_details ON lecturer_unit_details.unit_id = unit_details.unit_code 
      INNER JOIN unit_semester_details ON unit_semester_details.unit_id = lecturer_unit_details.unit_id
      INNER JOIN unit_course_details ON unit_course_details.unit_id = lecturer_unit_details.unit_id
      INNER JOIN course_details ON course_details.course_id = unit_course_details.course_id
      INNER JOIN academic_year ON academic_year.academic_year_id = lecturer_unit_details.academic_year_id 
      WHERE lecturer_unit_details.lecturer_id = '$pfno'
       ";
      $data_result = mysqli_query($db, $data_fetch_query);

      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $id = $row['id'];
              $unit_id = $row['unit_id'];
              $unit_name = $row['unit_name'];
              $unit_type = $row['unit_type'];
              $unit_active = $row['unit_active'];//string (1,0)
              $course_id = $row['course_id'];
              $course_short_name = $row['course_shortform'];
              $date_added = $row['date_added'];
              $semester_id = $row['semester_id'];
            //   $semester_name = $row['semester_name'];
              $academic_yr = $row['academic_year'];


                echo "<tr> <td>" .$unit_id.  "</td>";
                echo "<td>" .$unit_name."</td>";
                echo "<td>" .$unit_type."</td>";
                echo "<td>" .$course_short_name."</td>";
                echo "<td>" .$academic_yr."</td>";
                echo "<td>" .$semester_id."</td>";
                echo "<td>" .$date_added."</td>";
                echo "<td>
                <form method ='POST' action=''>
                <input  type='text' hidden name='unit_id' value='$unit_id'>
                <input type='submit' data-id= '$unit_id' value='Delete'  class='btn btn-danger deleteUnitBtn'>
                </form>
                </td> </tr>";
      }
      
      }else{
      echo "<td>"."No Requests Found"."</td>";
      }
      
      } else{
          echo "<td>"."No Data Found"."</td>";
      }

?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Unit ID</th>
                                        <th>Unit Name</th>
                                        <th>Unit Type</th>
                                        <th>Course</th>
                                        <th>Group</th>
                                        <th>Semester</th>
                                        <th>Date Selected</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->


        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <?php
    include '../assets/components/footer.php';
    ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- delete Unit modal-->
    <div class="modal" id='deleteUnitModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color:red">⚠ Warning!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="modal-body">
                        <p>Are you sure you want to de-select this Unit?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" id="unitID" required hidden readonly
                                    name='unit_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='delete-unit-btn' class="btn btn-danger">Yes,Confirm</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

    // delete Unit modal query
    function deleteUnitModal() {
        $("#deleteUnitModal").modal("show");
    }
    let deleteBtns = document.querySelectorAll(".deleteUnitBtn");
    deleteBtns.forEach(function(deleteBtn) {
        value = ""
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let unit_id = deleteBtn.dataset.id;

            document.getElementById("unitID").value = unit_id;

            deleteUnitModal();
        });
    });
    </script>

</body>

</html>