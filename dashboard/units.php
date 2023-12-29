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

// Update Unit Details
if (isset($_POST['update-unit-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $crs_id = $_POST['uni_course_id'];
  $unit_code = $_POST['unit_code'];
  $unit_name = $_POST['unit_name'];
  $unit_type = $_POST['unit_type'];
  $uni_semester_id = $_POST['uni_semester_id'];
  $unit_status = $_POST['unit_status_id'];


//Data Validation
  if (empty($crs_id)) {
  	array_push($errors, "Course ID is required");
  }
  if (empty($unit_code)) {
  	array_push($errors, "Unit ID is required");
  }
  if (empty($unit_name)) {
  	array_push($errors, "Unit Name is required");
  }
  if (empty($unit_type)) {
  	array_push($errors, "Unit Type is required");
  }
  if (empty($uni_semester_id)) {
  	array_push($errors, "Unit Semester ID is required");
  }
  if (empty($unit_status)) {
  	array_push($errors, "Unit Status is required");
  }

if (count($errors) == 0) {
  $unit_data_update_query = "UPDATE `unit_details` SET `unit_name`='$unit_name',`unit_type`='$unit_type',`unit_active`='$unit_status' WHERE `unit_code` = '$unit_code' ";
  $unit_results = mysqli_query($db, $unit_data_update_query);

  $unit_crs_update_query = "UPDATE `unit_course_details` SET `course_id`='$crs_id' WHERE `unit_id` = '$unit_code' ";
  $unit_crs_results = mysqli_query($db, $unit_crs_update_query);

  $unit_sem_update_query = "UPDATE `unit_semester_details` SET `semester_id`='$uni_semester_id' WHERE `unit_id` = '$unit_code' ";
  $unit_sem_results = mysqli_query($db, $unit_sem_update_query);

  header('location: units.php');
  }else{
  array_push($errors, "Unable to update unit details");
  header('location: units.php');
  }
}
}

  // Delete unit Details
if (isset($_POST['delete-unit-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $unitID = $_POST['unit_id'];
  
  if (empty($unitID)) {
    array_push($errors, "Unit ID is required");
  }
  if (count($errors) == 0) {
      $unit_data_delete_query = "DELETE FROM `unit_details` WHERE `unit_code`='$unitID' ";
      $results = mysqli_query($db, $unit_data_delete_query);

        header('location: units.php');
      }else{
        array_push($errors, "Unable to delete unit");
        header('location: units.php');
      }
  }
}

//add unit
if (isset($_POST['add-unit-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $course_id = $_POST['uni_course_id'];
  $unit_code = $_POST['unit_code'];
  $unit_name = $_POST['unit_name'];
  $unit_type = $_POST['unit_type'];
  $unit_status = $_POST['unit_status'];
  $sem_id = $_POST['uni_semester_id'];


  if (empty($unit_code)) {
    array_push($errors, "Unit ID is required");
  }
  if (empty($unit_name)) {
    array_push($errors, "Unit Name is required");
  }
  if (empty($unit_type)) {
    array_push($errors, "Unit Type is required");
  }
  if (empty($unit_status)) {
    array_push($errors, "Unit Status is required");
  }
  if (empty($sem_id)) {
    array_push($errors, "Sem ID is required");
  }

  
  if (count($errors) == 0) {
    $add_unit_query = "INSERT INTO `unit_details`(`unit_code`, `unit_name`, `unit_type`, `unit_active`) VALUES ('$unit_code','$unit_name','$unit_type','$unit_status')";
    $results = mysqli_query($db, $add_unit_query);

    // //link unit with course
    $add_crs_unit_query = "INSERT INTO `unit_course_details`(`unit_id`, `course_id`) VALUES ('$unit_code','$course_id')";
    $results_crs_unit = mysqli_query($db, $add_crs_unit_query);

    // //link unit with semester
    $add_crs_sem_query = "INSERT INTO `unit_semester_details`(`unit_id`, `semester_id`) VALUES ('$unit_code','$sem_id')";
    $results_crs_unit = mysqli_query($db, $add_crs_sem_query);

      header('location: ./units.php');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: ./units.php');
    }
  }
}
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Units| EDUTIME</title>
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
                            <h5 class="card-title">List of Units</h5>
                            <input type='button' value='Add a Unit' name='open-unit-modal-btn'
                                class='btn btn-primary float-end open-unit-modal-btn m-2'>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Unit ID</th>
                                        <th>Unit Name</th>
                                        <th>Unit Type</th>
                                        <th>Status</th>
                                        <th>Course</th>
                                        <th>Semester</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `unit_details` INNER JOIN unit_course_details ON unit_course_details.unit_id = unit_details.unit_code INNER JOIN course_details ON unit_course_details.course_id = course_details.course_id INNER JOIN unit_semester_details ON unit_semester_details.unit_id = unit_details.unit_code INNER JOIN semester_details ON semester_details.semester_id = unit_semester_details.semester_id ";
      $data_result = mysqli_query($db, $data_fetch_query);

      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $id = $row['id'];
              $unit_id = $row['unit_code'];
              $unit_name = $row['unit_name'];
              $unit_type = $row['unit_type'];
              $unit_active = $row['unit_active'];//string (1,0)
              $course_id = $row['course_id'];
              $course_short_name = $row['course_shortform'];
              $date_added = $row['date_added'];
              $semester_id = $row['semester_id'];
              $semester_name = $row['semester_name'];


                echo "<tr> <td>" .$unit_id.  "</td>";
                echo "<td>" .$unit_name."</td>";
                echo "<td>" .$unit_type."</td>";
                echo "<td>" .$unit_active."</td>";
                echo "<td>" .$course_short_name."</td>";
                echo "<td>" .$semester_id."</td>";
                echo "<td>" .$date_added."</td>";
                echo "<td>
                <form method ='POST' action=''>
                <input  type='text' hidden name='unit_id' value='$unit_id'>
                <input type='submit' data-id='$unit_id'  data-unit_name='$unit_name' data-unit_type='$unit_type' data-unit_status='$unit_active' data-course_id='$course_id' data-sem_id='$semester_id' data-sem_name='$semester_name'  value='Edit Details' name='edit-unit-btn' class='btn btn-success edit-unit-modal-btn m-2'>
                <input type='submit' data-id= '$unit_id' value='Delete Unit'  class='btn btn-danger deleteUnitBtn'>
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
                                        <th>Status</th>
                                        <th>Course</th>
                                        <th>Semester</th>
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
                        <p>Are you sure you want to delete this Unit?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" hidden class="form-control" id="unitID" required readonly
                                    name='unit_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='delete-unit-btn' class="btn btn-danger">Yes,Delete!</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!--edit Unit details-->
    <div class="modal fade" id="editUnitModal" tabindex="-1" role="dialog" aria-labelledby="editUnitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUnitModalLabel">Edit Unit Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="uni_course_id">Select Course:</label>
                            <select class="form-control" id="uni_course_id" name="uni_course_id" required>
                                <option value="">Select Course..</option>
                                <?php 
    // Retrieve the departments from the database
    $sql=mysqli_query($db,"select * from course_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['course_id']);?>">
                                    <?php echo htmlentities($rw['course_name']);?></option>
                                <?php
    }
    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="unit_code" readonly hidden class="form-control" id="unit_code_id"
                                required placeholder="e.g CIT 101">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Unit Name:</label>
                            <input type="text" name="unit_name" class="form-control" id="unit_name_id" required
                                placeholder="e.g Software Project Management">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Unit Type:</label>
                            <select class="form-control" id="unit_type_id" name="unit_type" required>
                                <option value="" selected>Select Unit Type...</option>
                                <option value="Theory">Theory</option>
                                <option value="ICT-Practical">ICT-Practical</option>
                                <option value="ELECT-Practical">Electronics-Practical</option>
                                <option value="CHEM-Practical">CHEM-Practical</option>
                                <option value="BIO-Practical">BIO-Practical</option>
                                <option value="PHY-Practical">PHY-Practical</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uni_semester_id">Select Semester:</label>
                            <select class="form-control" id="uni_semester_id" name="uni_semester_id" required>
                                <option value="">Select Semester..</option>
                                <?php 
    // Retrieve the semesters from the database
    $sql=mysqli_query($db,"select * from semester_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['semester_id']);?>">
                                    <?php echo htmlentities($rw['semester_name']);?></option>
                                <?php
    }
    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Unit Status:</label>
                            <select class="form-control" id="unit_status_id" name="unit_status_id" required>
                                <option selected>select status...</option>
                                <option value="Active">Active</option>
                                <option value="In-Active">In-Active</option>

                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="update-unit-details-btn">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- add new unit-->
    <div class="modal fade" id="addUnitModal" tabindex="-1" role="dialog" aria-labelledby="addUnitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUnitModalLabel">Add a Unit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="uni_course_id">Select Course:</label>
                            <select class="form-control" id="uni_course_id" name="uni_course_id" required>
                                <option value="">Select Course..</option>
                                <?php 
    // Retrieve the departments from the database
    $sql=mysqli_query($db,"select * from course_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['course_id']);?>">
                                    <?php echo htmlentities($rw['course_name']);?></option>
                                <?php
    }
    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Unit Code:</label>
                            <input type="text" name="unit_code" class="form-control" id="unit_code_id" required
                                placeholder="e.g CIT 101">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Unit Name:</label>
                            <input type="text" name="unit_name" class="form-control" id="unit_name_id" required
                                placeholder="e.g Software Project Management">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Unit Type:</label>
                            <select class="form-control" id="unit_type_id" name="unit_type" required>
                                <option value="" selected>Select Unit Type...</option>
                                <option value="Theory">Theory</option>
                                <option value="ICT-Practical">ICT-Practical</option>
                                <option value="ELECT-Practical">Electronics-Practical</option>
                                <option value="CHEM-Practical">CHEM-Practical</option>
                                <option value="BIO-Practical">BIO-Practical</option>
                                <option value="PHY-Practical">PHY-Practical</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="uni_semester_id">Select Semester:</label>
                            <select class="form-control" id="uni_semester_id" name="uni_semester_id" required>
                                <option value="">Select Semester..</option>
                                <?php 
    // Retrieve the semesters from the database
    $sql=mysqli_query($db,"select * from semester_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['semester_id']);?>">
                                    <?php echo htmlentities($rw['semester_name']);?></option>
                                <?php
    }
    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Unit Status:</label>
                            <select class="form-control" id="unit_status_id" name="unit_status" required>
                                <option value="" selected>select status...</option>
                                <option value="Active">Active</option>
                                <option value="In-Active">In-Active</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info" name="add-unit-btn">Submit</button>
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

    //add Unit details modal code
    function openUnitModal() {
        $("#addUnitModal").modal("show");
    }
    let openAddUnitModalBtn = document.querySelector(".open-unit-modal-btn");
    openAddUnitModalBtn.addEventListener("click", function(e) {
        e.preventDefault();
        openUnitModal();
    });

    // //edit Unit details modal code
    function editUnitModal() {
        $("#editUnitModal").modal("show");
    }
    let editButtons = document.querySelectorAll(".edit-unit-modal-btn");
    editButtons.forEach(function(editButton) {
        editButton.addEventListener("click", function(e) {
            e.preventDefault();

            let unitid = editButton.dataset.id;
            let unit_name = editButton.dataset.unit_name;
            let unit_type = editButton.dataset.unit_type;
            let unit_status = editButton.dataset.unit_status;
            let course_id = editButton.dataset.course_id;
            let sem_id = editButton.dataset.sem_id;
            let sem_name = editButton.dataset.sem_name;

            document.getElementById("uni_course_id").value = course_id;
            // pre-select the option in the dropdown menu
            const course_select = document.querySelector('#uni_course_id');
            course_select.value = course_id;

            document.getElementById("unit_code_id").value = unitid;
            document.getElementById("unit_name_id").value = unit_name;

            document.getElementById("unit_type_id").value = unit_type;
            // pre-select the option in the dropdown menu
            const type_select = document.querySelector('#unit_type_id');
            type_select.value = unit_type;

            document.getElementById("uni_semester_id").value = sem_id;
            // pre-select the option in the dropdown menu
            const sem_select = document.querySelector('#uni_semester_id');
            sem_select.value = sem_id;

            document.getElementById("unit_status_id").value = unit_status;
            // pre-select the option in the dropdown menu
            const status_select = document.querySelector('#unit_status_id');
            // alert(typeof parseInt(unit_status));
            status_select.value = unit_status;
            // alert(unit_status)

            editUnitModal();
        });
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