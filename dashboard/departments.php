<?php
include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}

//deny access to schools.php if user is not an admin
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

// Update Department Details
if (isset($_POST['update-department-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin' || $_SESSION['role_name'] == 'Dean'){
  $department_id = $_POST['dpt_id'];
  $department_name = $_POST['dpt_name'];


//Data Validation
  if (empty($department_id)) {
  	array_push($errors, "Department ID is required");
  }
  if (empty($department_name)) {
  	array_push($errors, "Department Name is required");
  }

if (count($errors) == 0) {
  $department_data_update_query = "UPDATE `department_details` SET `department_name`='$department_name' WHERE `department_id` ='$department_id' ";
  $results = mysqli_query($db, $department_data_update_query);

  header('location: departments.php');
  }else{
  array_push($errors, "Unable to push updates");
  header('location: departments.php');
  }
}
}

  // Delete department Details
if (isset($_POST['delete-department-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $departmentID = $_POST['department_id'];
  
  if (empty($departmentID)) {
    array_push($errors, "Department ID is required");
  }
  if (count($errors) == 0) {
      $dpt_data_delete_query = "DELETE FROM `department_details` WHERE `department_id`='$departmentID' ";
      $results = mysqli_query($db, $dpt_data_delete_query);

        header('location: departments.php');
      }else{
        array_push($errors, "Unable to delete department");
        header('location: departments.php');
      }
  }
}

function capitalizeWords($string) {
  return ucwords(strtolower($string));
}

function generate_department_id($faculty_name, $department_name) {
  $dpt_prefix = 'DPT';
  // Convert faculty and department names to uppercase
  $faculty_name = strtoupper($faculty_name);
  $department_name = strtoupper($department_name);

  // Remove any non-alphabetic characters from the faculty and department names
  $faculty_name = preg_replace('/[^A-Z]/', '', $faculty_name);
  $department_name = preg_replace('/[^A-Z]/', '', $department_name);

  function slugify($string) {
    return strtoupper(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}


  // Extract the first two letters of the faculty name and the last two letters of the department name
  $faculty_code = substr($faculty_name, 0, 4);
  $department_code = slugify($department_name);

  // Combine the faculty code, department code to form the department ID
  $department_id = $dpt_prefix."_". $department_code;

  // Return the department ID
  return $department_id;
}



//add department
if (isset($_POST['add-department-btn'])) {
  $school_id = $_POST['uni_schools'];
  $dpt_name = $_POST['department_name'];

  if (empty($school_id)) {
    array_push($errors, "School ID is required");
  }
  if (empty($dpt_name)) {
    array_push($errors, "Department name is required");
  }
  
  if (count($errors) == 0) {
    // Example usage of generate_dpt_id function

    //generate department id
$department_id = generate_department_id($school_id, $dpt_name);

    $add_dpt_query = "INSERT INTO `department_details`(`department_id`, `department_name`) VALUES ('$department_id','$dpt_name')";
    $results = mysqli_query($db, $add_dpt_query);

    //link sch with dpt
    $add_sch_dpt_query = "INSERT INTO `school_department_details`(`school_id`, `department_id`) VALUES ('$school_id','$department_id')";
    $results_sch_dpt = mysqli_query($db, $add_sch_dpt_query);

      header('location: ./departments.php');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: ./departments.php');
    }
  }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Departments | EDUTIME</title>
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
                    <h4 class="page-title">Departments Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Departments
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
                            <h5 class="card-title">List of Departments</h5>
                            <input type='button' value='Add a Department' name='open-department-modal-btn'
                                class='btn btn-primary float-end open-department-modal-btn m-2'>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Department ID</th>
                                        <th>Department Name</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  if($_SESSION['role_name'] == 'Admin' || $_SESSION['role_name'] == 'Dean'){
      $data_fetch_query = "SELECT * FROM `department_details`";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $department_id = $row['department_id'];
              $department_name = $row['department_name'];
              $date_created = $row['date_created'];



      echo "<tr> <td>" .$department_id.  "</td>";
      echo "<td>" .$department_name."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='Department_id' value='$department_id'>
      <input type='submit' data-dptid='$department_id'  data-dptname='$department_name'  value='Edit Details' name='edit-department-btn' class='btn btn-success edit-department-modal-btn m-2'>
      <input type='submit' data-id= '$department_id' value='Delete Department'  class='btn btn-danger deleteDepartmentBtn'>
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
                                        <th>Department ID</th>
                                        <th>Department Name</th>
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
    <div class="modal" id='deleteDepartmentModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
                        <p>Are you sure you want to delete this Department?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" hidden class="form-control" id="departmentID" required readonly
                                    name='department_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='delete-department-btn'
                                    class="btn btn-danger">Yes,Delete!</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!--edit Department details-->
    <div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog"
        aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">

                        <input type="text" readonly hidden name="dpt_id" class="form-control" id="dpt_id" required>

                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Department Name:</label>
                            <input type="text" name="dpt_name" class="form-control" id="dpt_name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" name="update-department-details-btn">Update
                                Details</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- add new Department-->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog"
        aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">Add a Department</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select School</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="uni_schools">
                                <option value="">Select School</option>
                                <?php $sql=mysqli_query($db,"select * from school_details");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
                                <option value="<?php echo htmlentities($rw['school_id']);?>">School of
                                    <?php echo htmlentities($rw['school_name']);?></option>
                                <?php
}
?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Department Name:</label>
                            <input type="text" name="department_name" class="form-control" id="dpt_name" required
                                placeholder="e.g Information Technology">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info" name="add-department-btn">Submit</button>
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

    //add Department details modal code
    function openDepartmentModal() {
        $("#addDepartmentModal").modal("show");
    }

    let openAddDepartmentModalBtn = document.querySelector(".open-department-modal-btn");
    openAddDepartmentModalBtn.addEventListener("click", function(e) {
        e.preventDefault();
        openDepartmentModal();
    });

    //edit Department details modal code
    function editDepartmentModal() {
        $("#editDepartmentModal").modal("show");
    }
    let editButtons = document.querySelectorAll(".edit-department-modal-btn");
    editButtons.forEach(function(editButton) {
        editButton.addEventListener("click", function(e) {
            e.preventDefault();

            let departmentid = editButton.dataset.dptid;
            let dpt_name = editButton.dataset.dptname;

            document.getElementById("dpt_id").value = departmentid;
            document.getElementById("dpt_name").value = dpt_name;

            editDepartmentModal();
        });
    });

    //delete Department modal query
    function deleteDepartmentModal() {
        $("#deleteDepartmentModal").modal("show");
    }
    let deleteBtns = document.querySelectorAll(".deleteDepartmentBtn");
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let dptid = deleteBtn.dataset.id;

            document.getElementById("departmentID").value = dptid;

            deleteDepartmentModal();
        });
    });
    </script>

</body>

</html>