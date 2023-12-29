<?php
include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}


//deny access to semesters.php if user is not an admin
if ($_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
  exit;
}
//Get Session data
$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

//add semester
if (isset($_POST['add-semester-btn'])) {
  $sem_id = $_POST['semester_id'];
  $sem_name = $_POST['semester_name'];

  if (empty($sem_id)) {
    array_push($errors, "Semester ID is required");
  }
  if (empty($sem_name)) {
    array_push($errors, "Semester name is required");
  }
  
  if (count($errors) == 0) {
    $add_sem_query = "INSERT INTO `semester_details`(`semester_id`, `semester_name`) VALUES ('$sem_id','$sem_name')";
    $results = mysqli_query($db, $add_sem_query);

      header('location: ./semesters.php');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: ./semesters.php');
    }
  }

// Update Semester Details
if (isset($_POST['update-semester-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $semester_id = $_POST['sem_id'];
  $semester_name = $_POST['sem_name'];

//Data Validation
  if (empty($semester_id)) {
  	array_push($errors, "Semester ID is required");
  }
  if (empty($semester_name)) {
  	array_push($errors, "Semester Name is required");
  }

if (count($errors) == 0) {
  $sem_data_update_query = "UPDATE `semester_details` SET `semester_name`='$semester_name' WHERE `semester_id`='$semester_id'";
  $results = mysqli_query($db, $sem_data_update_query);

  header('location: semesters.php');
  }else{
  array_push($errors, "Unable to push semester updates");
  header('location: semesters.php');
  }
}
}

  // Delete semester Details
if (isset($_POST['delete-semester-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $semesterID = $_POST['semester_id'];
  
  if (empty($semesterID)) {
    array_push($errors, "Semester ID is required");
  }
  if (count($errors) == 0) {
      $sem_data_delete_query = "DELETE FROM `semester_details` WHERE `semester_id`='$semesterID' ";
      $results = mysqli_query($db, $sem_data_delete_query);

        header('location: semesters.php');
      }else{
        array_push($errors, "Unable to delete department");
        header('location: semesters.php');
      }
  }
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Semesters | EDUTIME</title>
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
                    <h4 class="page-title">Semester Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Semesters
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
                            <h5 class="card-title">List of Semesters</h5>
                            <input type='button' value='Add a Semester' name='open-semester-modal-btn'
                                class='btn btn-primary float-end open-semester-modal-btn m-2'>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Semester ID</th>
                                        <th>Semester Name</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  if($_SESSION['role_name'] == 'Admin' || $_SESSION['role_name'] == 'Dean'){
      $data_fetch_query = "SELECT * FROM `semester_details`";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $semester_id = $row['semester_id'];
              $semester_name = $row['semester_name'];
              $date_created = $row['date_added'];

      echo "<tr> <td>" .$semester_id.  "</td>";
      echo "<td>" .$semester_name."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='semester_id' value='$semester_id'>
      <input type='submit' data-semid='$semester_id'  data-sem_name='$semester_name'  value='Edit Details' name='edit-semester-btn' class='btn btn-success edit-semester-modal-btn m-2'>
      <input type='submit' data-id= '$semester_id' value='Delete Semester'  class='btn btn-danger deleteSemesterBtn'>
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
                                        <th>Semester ID</th>
                                        <th>Semester Name</th>
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

    <!-- add new Semester-->
    <div class="modal fade" id="addSemesterModal" tabindex="-1" role="dialog" aria-labelledby="addSemesterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSemesterModalLabel">Add a Semester</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Semester ID:</label>
                            <input type="text" name="semester_id" class="form-control" id="sem_id" required
                                placeholder="e.g Y1S1">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Semester Name:</label>
                            <input type="text" name="semester_name" class="form-control" id="sem_name_id" required
                                placeholder="e.g Year 1 Semester 1">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info" name="add-semester-btn">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--edit Semester details-->
    <div class="modal fade" id="editSemesterModal" tabindex="-1" role="dialog" aria-labelledby="editSemesterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSemesterModalLabel">Edit Semester Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <input type="text" readonly name="sem_id" readonly hidden class="form-control" id="semester_id"
                            required>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Semester Name:</label>
                            <input type="text" name="sem_name" class="form-control" id="semester_name_id" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" name="update-semester-details-btn">Update
                                Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Delete semester model-->
    <div class="modal" id='deleteSemesterModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
                        <p>Are you sure you want to delete this Semester?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" hidden class="form-control" id="semesterID" required readonly
                                    name='semester_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='delete-semester-btn'
                                    class="btn btn-danger">Yes,Delete!</button>
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

    //add Semester details modal code
    function openSemesterModal() {
        $("#addSemesterModal").modal("show");
    }
    let openAddSemesterModalBtn = document.querySelector(".open-semester-modal-btn");

    openAddSemesterModalBtn.addEventListener("click", function(e) {
        e.preventDefault();
        openSemesterModal();
    });

    //edit Semester details modal code
    function editSemesterModal() {
        $("#editSemesterModal").modal("show");
    }
    let editButtons = document.querySelectorAll(".edit-semester-modal-btn");
    editButtons.forEach(function(editButton) {
        editButton.addEventListener("click", function(e) {
            e.preventDefault();

            let sem_id = editButton.dataset.semid;
            let sem_name = editButton.dataset.sem_name;

            document.getElementById("semester_id").value = sem_id;
            document.getElementById("semester_name_id").value = sem_name;

            editSemesterModal();
        });
    });

    //delete Semester modal query
    function deleteSemesterModal() {
        $("#deleteSemesterModal").modal("show");
    }
    let deleteBtns = document.querySelectorAll(".deleteSemesterBtn");
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let sem_id = deleteBtn.dataset.id;

            document.getElementById("semesterID").value = sem_id;

            deleteSemesterModal();
        });
    });
    </script>

</body>

</html>