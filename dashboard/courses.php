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

// Update Course Details
if (isset($_POST['update-course-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $crs_id = $_POST['crs_id'];
  $department_id = $_POST['crs_dpt_id'];
  $course_name = $_POST['crs_name'];
  $course_short_name = $_POST['crs_short_name'];


//Data Validation
  if (empty($crs_id)) {
  	array_push($errors, "Course ID is required");
  }
  if (empty($department_id)) {
  	array_push($errors, "Department ID is required");
  }
  if (empty($course_name)) {
  	array_push($errors, "Course Name is required");
  }
  if (empty($course_short_name)) {
  	array_push($errors, "Course Short Name is required");
  }

if (count($errors) == 0) {
  $course_data_update_query = "UPDATE `course_details` SET `course_name`='$course_name',`course_shortform`='$course_short_name' WHERE `course_id` ='$crs_id'";
  $results = mysqli_query($db, $course_data_update_query);

  $crs_dpt_update_query = "UPDATE `department_course_details` SET `department_id`='$department_id' WHERE `course_id` ='$crs_id'";
  $results = mysqli_query($db, $crs_dpt_update_query);

  header('location: courses.php');
  }else{
  array_push($errors, "Unable to push updates");
  header('location: courses.php');
  }
}
}

  // Delete course Details
if (isset($_POST['delete-course-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $courseID = $_POST['course_id'];
  
  if (empty($courseID)) {
    array_push($errors, "Course ID is required");
  }
  if (count($errors) == 0) {
      $crs_data_delete_query = "DELETE FROM `course_details` WHERE `course_id`='$courseID' ";
      $results = mysqli_query($db, $crs_data_delete_query);

        header('location: courses.php');
      }else{
        array_push($errors, "Unable to delete Course");
        header('location: courses.php');
      }
  }
}

function generate_course_id($department_id,$course_name) {
  $crs_prefix = 'CRS';
  $course_id =strtoupper($crs_prefix."_".$course_name);
  return $course_id;
}

//add course
if (isset($_POST['add-course-btn'])) {
  $department_id = $_POST['uni_departments'];
  $crs_name = $_POST['course_name'];
  $crs_short_name = $_POST['crs_short_name'];

  if (empty($department_id)) {
    array_push($errors, "Department ID is required");
  }
  if (empty($crs_name)) {
    array_push($errors, "Course name is required");
  }
  if (empty($crs_short_name)) {
    array_push($errors, "Course short name is required");
  }
  
  if (count($errors) == 0) {

    //generate department id
    $course_id = generate_course_id($department_id,$crs_short_name);

    $add_crs_query = "INSERT INTO `course_details`(`course_id`, `course_name`,`course_shortform`) VALUES ('$course_id','$crs_name','$crs_short_name')";
    $results = mysqli_query($db, $add_crs_query);

    //link crs with department
    $add_dpt_crs_query = "INSERT INTO `department_course_details`(`department_id`, `course_id`) VALUES ('$department_id','$course_id')";
    $results_dpt_crs_dpt = mysqli_query($db, $add_dpt_crs_query);

      header('location: ./courses.php');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: ./courses.php');
    }
  }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Courses | EDUTIME</title>
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
                    <h4 class="page-title">Course Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Courses
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
                            <h5 class="card-title">List of Courses</h5>
                            <input type='button' value='Add a Course' name='open-course-modal-btn'
                                class='btn btn-primary float-end open-course-modal-btn m-2'>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Course ID</th>
                                        <th>Course Name</th>
                                        <th>Short Form</th>
                                        <th>Department</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `course_details` INNER JOIN department_course_details ON department_course_details.course_id = course_details.course_id INNER JOIN department_details ON department_course_details.department_id = department_details.department_id INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id INNER JOIN school_details ON school_details.school_id =school_department_details.school_id ";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $course_id = $row['course_id'];
              $course_name = $row['course_name'];
              $shortname = $row['course_shortform'];
              $school_name = $row['school_name'];
              $department_id = $row['department_id'];
              $department_name = $row['department_name'];
              $date_created = $row['date_added'];

      echo "<tr> <td>" .$course_id.  "</td>";
      echo "<td>" .$course_name."</td>";
      echo "<td>" .$shortname."</td>";
      echo "<td>" .$department_name."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='course_id' value='$course_id'>
      <input type='submit' data-crsid='$course_id'  data-crsname='$course_name' data-crs_short_name='$shortname' data-crs_dpt_id='$department_id' value='Edit Details' name='edit-course-btn' class='btn btn-success edit-course-modal-btn m-2'>
      <input type='submit' data-id= '$course_id' value='Delete Course'  class='btn btn-danger deleteCourseBtn'>
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
                                        <th>Course ID</th>
                                        <th>Course Name</th>
                                        <th>Short Form</th>
                                        <th>Department</th>
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

    <!-- delete course modal-->
    <div class="modal" id='deleteCourseModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
                        <p>Are you sure you want to delete this Course?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" hidden class="form-control" id="courseID" required readonly
                                    name='course_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='delete-course-btn'
                                    class="btn btn-danger">Yes,Delete!</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!--edit Course details-->
    <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <input type="text" readonly name="crs_id" class="form-control" id="crs_id" required>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Department Name:</label>
                            <select class="form-control" id="crs_dpt_id" name="crs_dpt_id" value="" required>
                                <option value="">Select Department..</option>
                                <?php 
    // Retrieve the departments from the database
    $sql=mysqli_query($db,"select * from department_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['department_id']);?>">Department of
                                    <?php echo htmlentities($rw['department_name']);?></option>
                                <?php
    }
    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Course Name:</label>
                            <input type="text" name="crs_name" class="form-control" id="crs_name" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Short Name:</label>
                            <input type="text" name="crs_short_name" class="form-control" id="crs_short_name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" name="update-course-details-btn">Update
                                Details</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- add new Course-->
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add a Course</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="uni_department_id">Select Department:</label>
                            <select class="form-control" id="uni_department_id" name="uni_departments" required>
                                <option value="">Select Department..</option>
                                <?php 
    // Retrieve the departments from the database
    $sql=mysqli_query($db,"select * from department_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
                                <option value="<?php echo htmlentities($rw['department_id']);?>">Department of
                                    <?php echo htmlentities($rw['department_name']);?></option>
                                <?php
    }
    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Course Name:</label>
                            <input type="text" name="course_name" class="form-control" id="crs_name" required
                                placeholder="e.g Bachelor of Science in Information Technology">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Short Name:</label>
                            <input type="text" name="crs_short_name" class="form-control" id="crs_short_name" required
                                placeholder="e.g IT">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info" name="add-course-btn">Submit</button>
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

    //add Course details modal code
    function openCourseModal() {
        $("#addCourseModal").modal("show");
    }
    let openAddCourseModalBtn = document.querySelector(".open-course-modal-btn");
    openAddCourseModalBtn.addEventListener("click", function(e) {
        e.preventDefault();
        openCourseModal();
    });

    // //edit Course details modal code
    function editCourseModal() {
        $("#editCourseModal").modal("show");
    }
    let editButtons = document.querySelectorAll(".edit-course-modal-btn");
    editButtons.forEach(function(editButton) {
        editButton.addEventListener("click", function(e) {
            e.preventDefault();

            let crsid = editButton.dataset.crsid;
            let crs_name = editButton.dataset.crsname;
            let crs_shortname = editButton.dataset.crs_short_name;
            let crs_dptname = editButton.dataset.crs_dpt_id;

            document.getElementById("crs_id").value = crsid;
            document.getElementById("crs_name").value = crs_name;
            document.getElementById("crs_short_name").value = crs_shortname;
            document.getElementById("crs_dpt_id").value = crs_dptname;

            // pre-select the option in the dropdown menu
            const select = document.querySelector('#crs_dpt_id');
            // console.log(select)
            select.value = crs_dptname;

            editCourseModal();
        });
    });


    // delete Course modal query
    function deleteCourseModal() {
        $("#deleteCourseModal").modal("show");
    }
    let deleteBtns = document.querySelectorAll(".deleteCourseBtn");
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let crsid = deleteBtn.dataset.id;

            document.getElementById("courseID").value = crsid;

            deleteCourseModal();
        });
    });
    </script>

</body>

</html>