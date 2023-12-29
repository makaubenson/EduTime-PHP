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
//Get Session data
$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

//Add group
//generate group id function
function generate_group_id($course_id) {
    // Slugify the group name
    $slugified_name = strtoupper(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $course_id)));
    //Generate random number
    $min = 10;
    $max = 1000;
    $random_number = rand($min, $max);

    // Add the prefix "GRP_" to the slugified name
    $group_id = "GRP_" . $slugified_name."_".$random_number;

    return $group_id;
}

if (isset($_POST['add-course-group-btn'])) {
  $course_id = $_POST['course_id'];
  $group_id = generate_group_id($course_id);
  $academic_year = $_POST['academic_yr_id'];
  $group_capacity = $_POST['group_capacity'];
 
  if (empty($course_id)) {
    array_push($errors, "Course ID is required");
  }
  if (empty($academic_year)) {
    array_push($errors, "Academic Year is required");
  }
  if (empty($group_capacity)) {
    array_push($errors, "Group Capacity is required");
  }


  if (count($errors) == 0) {
    $add_crs_grp_query = "INSERT INTO `course_group_details`(`group_id`, `course_id`, `academic_year_id`, `group_number`) VALUES ('$group_id','$course_id','$academic_year','$group_capacity')";
    $results = mysqli_query($db,$add_crs_grp_query);

      header('location: ./course-groups.php');
    }else{
      array_push($errors, "Unable to add room");
      header('location: ./course-groups.php');
    }
  }

// Update Group Details
if (isset($_POST['update-course-group-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $group_id = $_POST['group_id'];
  $course_id = $_POST['course_id'];
  $academic_year = $_POST['academic_yr'];
  $group_capacity = $_POST['group_capacity'];

//Data Validation
  if (empty($group_id)) {
  	array_push($errors, "Group ID is required");
  }
  if (empty($course_id)) {
  	array_push($errors, "Course ID is required");
  }
  if (empty($academic_year)) {
  	array_push($errors, "Academic Year is required");
  }
  if (empty($group_capacity)) {
  	array_push($errors, "Group Capacity is required");
  }


if (count($errors) == 0) {
  $group_data_update_query = "UPDATE `course_group_details` SET `course_id`='$course_id',`academic_year_id`='$academic_year',`group_number`='$group_capacity' WHERE `group_id`='$group_id'";
  $results = mysqli_query($db, $group_data_update_query);

  header('location: course-groups.php');
  }else{
  array_push($errors, "Unable to push room updates");
  header('location: course-groups.php');
  }
}
}

  // Delete course-group Details
if (isset($_POST['course-group-delete-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $groupID = $_POST['group_id'];
  
  if (empty($groupID)) {
    array_push($errors, "Group ID is required");
  }

  if (count($errors) == 0) {
      $group_data_delete_query = "DELETE FROM `course_group_details` WHERE `group_id`='$groupID' ";
      $results = mysqli_query($db, $group_data_delete_query);

        header('location: course-groups.php');
      }else{
        array_push($errors, "Unable to delete this course group");
        header('location: course-groups.php');
      }
  }
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Course Groups | EDUTIME</title>
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
                    <h4 class="page-title">Course Group Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Groups
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
                            <h5 class="card-title">Course Groups</h5>
                            <input type='button' value='Add a Course Group' name='open-course-group-modal-btn'
                                class='btn btn-primary float-end open-course-group-modal-btn m-2'>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Group ID</th>
                                        <th>Course Name</th>
                                        <th>Academic Year</th>
                                        <th>Group Number</th>
                                        <th>Date Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `course_group_details` INNER JOIN course_details ON course_group_details.course_id = course_details.course_id INNER JOIN academic_year ON academic_year.academic_year_id = course_group_details.academic_year_id";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $group_id = $row['group_id'];
              $course_id = $row['course_id'];
              $course_name = $row['course_name'];
              $course_shortform = $row['course_shortform'];
              $academic_year_id = $row['academic_year_id'];
              $academic_year = $row['academic_year'];
              $group_number = $row['group_number'];
              $date_updated= $row['date_added'];

      echo "<tr> <td>" .$group_id.  "</td>";
      echo "<td>" .$course_shortform."</td>";
      echo "<td>" .$academic_year."</td>";
      echo "<td>" .$group_number."</td>";
      echo "<td>" .$date_updated."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='group_id' value='$group_id'>
      <input type='submit' data-group_id='$group_id' data-course_id='$course_id' data-academic_year_id='$academic_year_id' data-group_capacity='$group_number' value='Edit Details' name='edit-course-group-btn' class='btn btn-success edit-course-group-modal-btn m-2'>
      <input type='submit' data-id= '$group_id' value='Delete Group'  class='btn btn-danger deleteGroupBtn'>
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
                                        <th>Group ID</th>
                                        <th>Course Name</th>
                                        <th>Academic Year</th>
                                        <th>Group Number</th>
                                        <th>Date Updated</th>
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

    <!-- add new academic group-->
    <div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="addGroupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModalLabel">Add a Group</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select a Course</label>
                            <select class="form-control" id="crs_id" name="course_id">
                                <option value="">Select a Course</option>
                                <?php $sql=mysqli_query($db,"select * from course_details");
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
                            <label for="exampleFormControlSelect1">Select an Academic Year</label>
                            <select class="form-control" id="academic_yr_id" name="academic_yr_id">
                                <option value="">Select Academic Year</option>
                                <?php $sql=mysqli_query($db,"select * from academic_year");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
                                <option value="<?php echo htmlentities($rw['academic_year_id']);?>">
                                    <?php echo htmlentities($rw['academic_year']);?></option>
                                <?php
}
?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Group Number:</label>
                            <input type="number" name="group_capacity" class="form-control" id="group_capacity_id"
                                required placeholder="e.g 120">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info" name="add-course-group-btn">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--edit Group details-->
    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">Edit Group Details:</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <input type="text" name="group_id" readonly hidden class="form-control" id="groupID"
                                required>
                            <label for="exampleFormControlSelect1">Select a Course</label>
                            <select class="form-control" id="courseId" name="course_id" value="">
                                <option value="">Select a Course</option>
                                <?php $sql=mysqli_query($db,"select * from course_details");
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
                            <label for="exampleFormControlSelect1">Select an Academic Year</label>
                            <select class="form-control" id="academic_yr" name="academic_yr">
                                <option value="">Select Academic Year</option>
                                <?php $sql=mysqli_query($db,"select * from academic_year");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
                                <option value="<?php echo htmlentities($rw['academic_year_id']);?>">
                                    <?php echo htmlentities($rw['academic_year']);?></option>
                                <?php
}
?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" readonly class="col-form-label">Group Number:</label>
                            <input type="number" name="group_capacity" class="form-control" id="group_capacity" required
                                placeholder="e.g 120">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info" name="update-course-group-btn">Update
                                Details</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--Delete Group model-->
    <div class="modal" id='deleteGroupModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
                        <p>Are you sure you want to delete this Group?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" id="groupID" required hidden readonly
                                    name='group_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='course-group-delete-btn'
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
<<<<<<< HEAD

=======
>>>>>>> 26c1e8df432250a03f9f27bbc568042bf38f8624
    <script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

    //add Room details modal code
    function openAddGroupModal() {
        $("#addGroupModal").modal("show");
    }
    let openAddGroupModalBtn = document.querySelector(".open-course-group-modal-btn");

    openAddGroupModalBtn.addEventListener("click", function(e) {
        e.preventDefault();
        openAddGroupModal();
    });

    //edit group details modal code
    function editGroupModal() {
        $("#editGroupModal").modal("show");
    }
    let editButtons = document.querySelectorAll(".edit-course-group-modal-btn");

    editButtons.forEach(function(editButton) {
        editButton.addEventListener("click", function(e) {
            e.preventDefault();

            let group_id = editButton.dataset.group_id;
            let course_id = editButton.dataset.course_id;
            let academic_year_id = editButton.dataset.academic_year_id;
            let group_capacity = editButton.dataset.group_capacity;

            document.getElementById("groupID").value = group_id;

            document.getElementById("courseId").value = course_id;
            // pre-select the option in the dropdown menu
            const selectedCourse = document.querySelector('#crs_id');
            selectedCourse.value = course_id;

            document.getElementById("academic_yr").value = academic_year_id;
            // pre-select the option in the dropdown menu
            const selectedAcademicYear = document.querySelector('#crs_id');
            selectedAcademicYear.value = academic_year_id;

            document.getElementById("group_capacity").value = group_capacity;
            editGroupModal();
        });
    });

    //   //delete Group modal query
    function deleteGroupModal() {
        $("#deleteGroupModal").modal("show");
    }

    let deleteBtns = document.querySelectorAll(".deleteGroupBtn");
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let group_id = deleteBtn.dataset.id;

            document.getElementById("groupID").value = group_id;

            deleteGroupModal();
        });
    });
    </script>

</body>

</html>