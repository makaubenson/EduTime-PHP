<?php
include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}

//deny access to courses.php if user is not an admin
if ($_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
  exit;
}

$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

function generate_academic_year_id($year1, $year2) {
  $crs_prefix = 'YR';
  $id =strtoupper($crs_prefix."_".$year1."_".$year2);
  return $id;
}

//add academic-year
if (isset($_POST['add-academic-year-btn'])) {
  $year_1 = $_POST['year1'];
  $year_2 = $_POST['year2'];
  $academic_yr = $_POST['academic_yr_group'];
  $year_status_id = $_POST['status_ID'];

  if (empty($year_1)) {
    array_push($errors, "Year 1 is required");
  }
  if (empty($year_2)) {
    array_push($errors, "Year 2 is required");
  }
  if (empty($academic_yr)) {
    array_push($errors, "Year is required");
  }
  if (empty($year_status_id)) {
    array_push($errors, "Status required");
  }

  if (count($errors) == 0) {
    //generate academic year id
    $academic_yr_id = generate_academic_year_id($year_1,$year_2);
    $academic_year = $year_1 ."/".$year_2;

    $add_academic_yr_query = "INSERT INTO `academic_year`(`academic_year_id`, `academic_year`,`Year`,`year_status`) VALUES ('$academic_yr_id','$academic_year','$academic_yr','$year_status_id')";
    $results = mysqli_query($db, $add_academic_yr_query);

      header('location: ./academic-year.php');
    }else{
      array_push($errors, "unable to add academic year");
      header('location: ./academic-year.php');
    }
  }

// Update Academic Year Details
if (isset($_POST['update-academic-year-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $academic_year_id = $_POST['academic_year_id'];
  $academic_year = $_POST['academic_year'];
  $stage_yr = $_POST['academic_yr_grp_id'];
  $yr_status = $_POST['yr_status_ID'];

//Data Validation
  if (empty($academic_year_id)) {
  	array_push($errors, "Academic Year ID is required");
  }
  if (empty($academic_year)) {
  	array_push($errors, "Academic Year is required");
  }
  if (empty($stage_yr)) {
  	array_push($errors, "Year is required");
  }
  if (empty($yr_status)) {
  	array_push($errors, "Staus required");
  }

if (count($errors) == 0) {
  $academic_yr_update_query = "UPDATE `academic_year` SET `academic_year`='$academic_year', `Year`='$stage_yr', `year_status`='$yr_status' WHERE `academic_year_id`='$academic_year_id'";
  $results = mysqli_query($db, $academic_yr_update_query);

  header('location: academic-year.php');
  }else{
  array_push($errors, "Unable to push updates");
  header('location: academic-year.php');
  }
}
}

  // Delete Academic Year Details
if (isset($_POST['delete-academic-year-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $academic_year_id = $_POST['academic_year_id'];
  
  if (empty($academic_year_id)) {
    array_push($errors, "Academic Year ID is required");
  }
  if (count($errors) == 0) {
      $academic_yr_data_delete_query = "DELETE FROM `academic_year` WHERE `academic_year_id`='$academic_year_id' ";
      $results = mysqli_query($db, $academic_yr_data_delete_query);

        header('location: academic-year.php');
      }else{
        array_push($errors, "Unable to delete academic year");
        header('location: academic-year.php');
      }
  }
}
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Academic Year | EDUTIME</title>
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
                    <h4 class="page-title">Academic Year Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Academic Year
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
                            <h5 class="card-title">List of Academic Years</h5>
                            <input type='button' value='Add an Academic Year' name='open-academic-year-btn'
                                class='btn btn-primary float-end open-academic-year-modal-btn m-2'>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Year ID</th>
                                        <th>Academic Year</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `academic_year`";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $year_id = $row['academic_year_id'];
              $year_desc = $row['academic_year'];
              $stage = $row['Year'];
              $yr_status = $row['year_status'];
              $date_created = $row['date_added'];

      echo "<tr> <td>" .$year_id.  "</td>";
      echo "<td>" .$year_desc."</td>";
      echo "<td>" .$stage."</td>";
      echo "<td>" .$yr_status."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='year_id' value='$year_id'>
      <input type='submit' data-id='$year_id' data-year_name='$year_desc' data-yr_stage='$stage' data-year_status='$yr_status' value='Edit Details' name='edit-academic-year-btn' class='btn btn-success edit-academic-year-btn m-2'>
      <input type='submit' data-id= '$year_id' value='Delete Academic Year'  class='btn btn-danger deleteAcademicYearBtn'>
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
                                        <th>Year ID</th>
                                        <th>Academic Year</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
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

    <!-- delete academic year modal-->
    <div class="modal" id='deleteAcademicYearModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
                        <p>Are you sure you want to delete this Academic Year?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" hidden class="form-control" id="academic_year_ID" required readonly
                                    name='academic_year_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='delete-academic-year-btn'
                                    class="btn btn-danger">Yes,Delete!</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- add new Academic Year-->
    <div class="modal fade" id="addAcademicYearModal" tabindex="-1" role="dialog"
        aria-labelledby="addAcademicYearModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAcademicYearModalLabel">
                        Add an Academic Year
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <div class="row">
                                <label for="academic-year">Academic Year e.g (2019/2020)</label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" placeholder="e.g 2019" name="year1"
                                        id="year1_id" required />
                                </div>
                                <div class="col-md-2">
                                    <p style="font-size: 24px">/</p>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" placeholder="e.g 2020" name="year2"
                                        id="year2_id" required />
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Year</label>
                                    <select class="form-control" id="exampleFormControlSelect1"
                                        name="academic_yr_group">
                                        <option value="">Select Year</option>
                                        <option value="Year 1">Year 1</option>
                                        <option value="Year 2">Year 2</option>
                                        <option value="Year 3">Year 3</option>
                                        <option value="Year 4">Year 4</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="status_ID">
                                        <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="In-Active">In Active</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-success" name="add-academic-year-btn">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--edit academic year details-->
    <div class="modal fade" id="editAcademicYearModal" tabindex="-1" role="dialog"
        aria-labelledby="editAcademicYearModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAcademicYearModalLabel">Edit Academic Year Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <div class="row">
                                <label for="academic year">Academic Year e.g (2019/2020)</label>
                                <div class="col-md-12 pb-4">
                                    <input type="text" class="form-control" readonly hidden name="academic_year_id"
                                        id="academic_year_id" required>
                                    <input type="text" class="form-control" placeholder="e.g 2019/2020"
                                        name="academic_year" id="academic_year_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Stage</label>
                                    <input type="text" class="form-control" placeholder="e.g Year 1"
                                        name="academic_yr_grp_id" id="academic_yr_grp_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="yr_status_ID"
                                        id="yr_status_id">
                                        <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="In-Active">In Active</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" name="update-academic-year-btn">Update
                                        Details</button>
                                </div>
                    </form>
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

    //add academic year details modal code
    function openAcademicYearModal() {
        $("#addAcademicYearModal").modal("show");
    }
    let openAcademicYearModalBtn = document.querySelector(".open-academic-year-modal-btn");
    openAcademicYearModalBtn.addEventListener("click", function(e) {
        e.preventDefault();
        openAcademicYearModal();
    });

    // //edit editAcademicYear details modal code
    function editAcademicYearModal() {
        $("#editAcademicYearModal").modal("show");
    }
    let editButtons = document.querySelectorAll(".edit-academic-year-btn");
    editButtons.forEach(function(editButton) {
        editButton.addEventListener("click", function(e) {
            e.preventDefault();

            let year_id = editButton.dataset.id;
            let academic_year_desc = editButton.dataset.year_name;
            let stage = editButton.dataset.yr_stage;
            let yr_status = editButton.dataset.year_status;

            document.getElementById("academic_year_id").value = year_id;
            document.getElementById("academic_year_name").value = academic_year_desc;
            document.getElementById("academic_yr_grp_id").value = stage;


            editAcademicYearModal();
        });
    });


    // delete Academic Year modal query
    function deleteAcademicYearModal() {
        $("#deleteAcademicYearModal").modal("show");
    }
    let deleteBtns = document.querySelectorAll(".deleteAcademicYearBtn");
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let academic_yr_id = deleteBtn.dataset.id;

            document.getElementById("academic_year_ID").value = academic_yr_id;

            deleteAcademicYearModal();
        });
    });
    </script>

</body>

</html>